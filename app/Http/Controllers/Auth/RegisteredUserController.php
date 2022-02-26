<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\ResponseTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    use ResponseTrait;
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', Rule::in(['LAKI-LAKI','PEREMPUAN'])],
            'nik'=> ['required', 'numeric', 'digits:16','unique:users'],
            'address'=>['required','string','max:255'],
            'blood_type'=>['required',Rule::in(['A','B','AB','O'])],
            'phone'=>['required','numeric','digits_between:10,13'],
            'emergency_contact'=>['required','numeric','digits_between:10,13'],
        ]);
        $requestData['password'] = Hash::make($requestData['password']);
        $user = User::create($requestData);

        event(new Registered($user));

        Auth::login($user);

        $api_token = \auth()->user()->createToken('API Token')->plainTextToken;

        $user =  UserResource::make(\auth()->user())->api_token($api_token);

        return $request->wantsJson() ? $this->success(['user'=>$user]): redirect(RouteServiceProvider::HOME);
    }
}
