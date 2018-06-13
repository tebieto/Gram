<?php

namespace App\Http\Controllers;

use App\User;
Use Auth;
Use Session;
use Storage;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($slug)
	{
	$user = User::where('slug', $slug)->first();
	if($user){
	return view('profiles.profile')	
	
	->with('user', $user);
	} else {
	return redirect()->route('home');	
	}
	}
	
	public function profile($slug)
	{
	$user = User::where('slug', $slug)->first();
	if($user){
	return $user;
	} else {
	return redirect()->route('home');	
	}
	}
	
	public function avatar($slug)
	{
	return User::where('slug', $slug)->first();
	
	}
	
	 public function edit()
	{
	$user = Auth::user();
	if($user){
	return view('profiles.edit')->with('info', Auth::user()->profile)->with('used', Auth::user());
	} else {
	return redirect()->route('home');	
	}
	}
	
	public function update(Request $r)
	{
	
	$this->validate($r, [
	'location' => 'required',
	'about' => 'required|max:255'
	]);
	
	Auth::user()->profile()->update([
	'location' => $r->location,
	'about' => $r->about
	]);
	
	if($r->hasFile('avatar'))
	{
	Auth::user()->update([
		
		'avatar' => asset(Storage::url($r->avatar->store('public/avatars')))
		
		]);	
		
	}
	
	Session::flash('success', 'profile updated.');
	return redirect()->back();
	}
}
