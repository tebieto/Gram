<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
Use App\User;

class FriendshipController extends Controller
{
    public function check($id)
	{
		if(Auth::user()->is_friends_with($id) === 1)
		{
			return ["status" => "friends"];
		}
		
		if(Auth::user()->has_pending_friend_requests_from($id) === 1)
			
			{
				return ["status" => "pending"];
			}
			
		if(Auth::user()->has_pending_friend_requests_sent_to($id) === 1)
			
			{
				return ["status" => "waiting"];
			}
			
		if(Auth::user()->is_friends_with($id) === 0)
		{
			return ["status" => 0];
		}
	}
	
	
	public function add_friend($id)
	{
		
		//sending notification, emails, broadcasting
		$resp = Auth::user()->add_friend($id);
		
		\App\User::find($id)->notify(new \App\Notifications\NewFriendRequest(Auth::user()));
		
		return $resp;
		
		
	}
	
	public function accept_friend($id)
	{
		
		//sending notification, emails, broadcasting
		$resp = Auth::user()->accept_friend($id);
		
		\App\User::find($id)->notify(new \App\Notifications\AcceptFriendRequest(Auth::user()));
		
		return $resp;
		
	}
	
	public function allfriends($slug)
	
	{
		$user = User::where('slug', $slug)
				->orderBy('created_at', 'DESC')->first();
		
		if($user){
			return view('profiles.friends')	
	
					->with('user', $user);
			} else {
			return redirect()->route('home');	
			}
		
	}
	
	public function allfollowers($slug)
	
	{
		$user = User::where('slug', $slug)
				->orderBy('created_at', 'DESC')->first();
		
		if($user){
			return view('profiles.followers')	
	
					->with('user', $user);
			} else {
			return redirect()->route('home');	
			}
		
	}
	
	public function allfollowing($slug)
	
	{
		$user = User::where('slug', $slug)
				->orderBy('created_at', 'DESC')->first();
		
		if($user){
			return view('profiles.following')	
	
					->with('user', $user);
			} else {
			return redirect()->route('home');	
			}
		
	}
	
}
