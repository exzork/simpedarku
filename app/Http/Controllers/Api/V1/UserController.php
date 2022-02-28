<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            return $this->success(['user'=>UserResource::make($user)]);
        }
        return $this->success(['users'=>UserResource::collection($users)]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('view', $user);
        return $this->success(['user'=>UserResource::make($user)->with_profile()]);
    }


    public function profile()
    {
        return $this->show(auth()->id());
    }

    public function updateProfile(Request $request){
        return $this->update($request, auth()->id());
    }

    public function logout(){
        auth()->user()->tokens->where('name', "API Token")->each->delete();
        return $this->success(null,204);
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

        $user = User::findOrFail($id);
        $validatedField = [
            'email' => 'filled|email|unique:users,email,'.$user->id,
            'address' => 'filled|string',
            'blood_type' => 'filled',
            'phone' => 'filled|digits_between:9,13',
            'emergency_phone' => 'filled|digits_between:9,13',
        ];
        if($id == auth()->id()){
            $validatedField['current_password'] = 'filled|current_password';
            if($request->get('password')!=""){
                $validatedField['password'] = 'filled|confirmed|min:6';
            }
        }

        $this->authorize('update', $user);
        $validatedData = $request->validate($validatedField);
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        $user->update($validatedData);
        return $this->success(['user'=>UserResource::make($user)->with_profile()]);
    }
}
