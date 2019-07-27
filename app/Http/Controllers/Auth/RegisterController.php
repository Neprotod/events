<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['required', 'string'],
            'mob_phone' => ['required', 'string', 'max:20'],
            'hobby' => ['required', 'string'],
            'birthday_dd' => ['required', 'integer',"min:1","max:31"],
            'birthday_mm' => ['required', 'integer',"min:1","max:12"],
            'birthday_yy' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['birthday'] = sprintf("%s-%s-%s", $data['birthday_yy'], $data['birthday_mm'], $data['birthday_dd']);

        return User::create([
            'full_name' => $data['full_name'],
            'mob_phone' => $data['mob_phone'],
            'hobby' => $data['hobby'],
            'birthday' => $data['birthday'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
