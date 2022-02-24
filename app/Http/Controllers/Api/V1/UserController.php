<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ResponseTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        if (!auth()->user()->is_admin) {
            $user = $users->where('id', auth()->user()->id)->first();
            return $this->success(UserResource::make($user));
        }
        return $this->success(UserResource::collection($users));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->error('User not found', 404);
        }

        try {
            $this->authorize('view', $user);
            return $this->success(UserResource::make($user)->with_profile());
        } catch (\Exception $e) {
            return $this->error('You are not authorized to view this user', 403);
        }
    }


    public function profile()
    {
        return $this->show(auth()->id());
    }

    public function updateProfile(Request $request){
        return $this->update($request, auth()->id());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(!$user){
            return $this->error('User not found',404);
        }

        try {
            $this->authorize('update', $user);

            $validator = Validator::make($request->all(),[
                'email' => 'filled|email|unique:users,email,'.$user->id,
                'address' => 'filled|string',
                'blood_type' => 'filled',
                'phone' => 'filled|phone',
                'emergency_phone' => 'filled|phone',
            ]);

            if($validator->fails()){
                return $this->error($validator->errors(),422);
            }

            $validatedData = $validator->validated();
            $user->update($validatedData);

            return $this->success(UserResource::make($user)->with_profile());
        }catch (\Exception $e){
            return $this->error('You are not authorized to update this user',403);
        }
    }
}
