<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Storage;
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
    protected $redirectTo = '/home';

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
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
			'gender' => 'required|bool',
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
		if($data['gender'])
		{
		$avatar = 'public/default/avatars/male.jpg';
        $avatar = asset(Storage::url($avatar));		
		}
		else
		{
		$avatar = 'public/default/avatars/female.jpg';	
		$avatar = asset(Storage::url($avatar));
		}	
		
		
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'gender' => $data['gender'],
            'password' => bcrypt($data['password']),
			'slug' => str_slug($data['name']),
			'avatar' => $avatar,
        ]);
		
		profile::create(['user_id' => $user->id]);
		
		return $user;
    }
}
