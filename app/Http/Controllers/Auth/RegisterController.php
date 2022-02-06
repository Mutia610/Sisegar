<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'name' => 'required|max:255',
            'level' => 'required',
            'gender' => 'required',
            'address' => 'required|max:255',
            'phone' => 'required|digits_between:10,12',
            'avatar' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $input = $data; 
        
        $avatarFile = $data['avatar'];
        $extention = $avatarFile->getClientOriginalExtension();
        $fileName = "user-avatar/" . date('YmdHis') . "." . $extention;
        $uploadPath = "uploads/user-avatar";
        $data['avatar']->move($uploadPath, $fileName);
        $input['avatar'] = $fileName;

        $input['password'] = \Hash::make($data['password']);

        return User::create($input);

    }
}
