<?php

namespace App\Traits;

use App\Friendship;

trait Friendable

{
	
	public function  add_friend($user_requested)
	
	{
		
	if($this->id === $user_requested)
	{
	return 0;
	}
	
	
	if($this->is_friends_with($user_requested)===1)
		
		{
		return "You are already friends";		
		}
		
	if($this->has_pending_friend_requests_sent_to($user_requested)===1)
		
		{
		return "already sent a friend request";		
		}
		
	
		
		
	if($this->has_pending_friend_requests_from($user_requested)===1)
		
		{
		return $this->accept_friend($user_requested);		
		}
		
	$Friendship = Friendship::create([
	
	'requester' => $this->id,
	'requested' => $user_requested
	
	]);
	
	if ($Friendship)
	{
		return 1;
	}
	return 0;
	}
	
	public function  accept_friend($requester)
	
	{
		
		if($this->is_friends_with($requester)===1)
		
		{
		return "You are already friends";		
		}
		
		if($this->has_pending_friend_requests_from($requester)===0)
		
		{
		return 0;		
		}
		
		
		
	$Friendship = Friendship::where('requester', $requester)
	->where('requested', $this->id)
	->first();
	
	if ($Friendship)
	{
		$Friendship->update([
		'status' => 1
		]);
		
		return 1;
	}
	
	return 0;
	
	}
	
	public function friends()
	{
		$friends = array();
		
		$f1 = Friendship:: where ('status', 1)
							->where('requester', $this->id)
							->get();
							
		foreach($f1 as $friendship):
		array_push($friends, \App\User::find($friendship->requested));
		endforeach;
		
		
		$friends2 = array();
		
		$f2 = Friendship:: where ('status', 1)
							->where('requested', $this->id)
							->get();
							
		foreach($f2 as $friendship):
		array_push($friends2, \App\User::find($friendship->requester));
		endforeach;
		
		return array_merge($friends, $friends2);
	}
	
	public function followers()
	{
		$followers = array();
		
		$f1 = Friendship:: where ('status', 0)
							->where('requested', $this->id)
							->get();
							
		foreach($f1 as $friendship):
		array_push($followers, \App\User::find($friendship->requester));
		endforeach;
		
		return ($followers);
	}
	
	
	public function following()
	{
		$following = array();
		
		$f2 = Friendship:: where ('status', 0)
							->where('requester', $this->id)
							->get();
							
		foreach($f2 as $friendship):
		array_push($following, \App\User::find($friendship->requested));
		endforeach;
		
		return ($following);
	}
	
	
	
	public function friends_ids()
	{
	return collect($this->friends())->pluck('id');
	}
	
	public function is_friends_with($user_id)
	{
			if(in_array($user_id, $this->friends_ids()->toArray()))
			{
				return 1;	
			}
			else
			{
				return 0;
			}
	}
	
	
	public function pending_friend_requests()
	{
	$users = array();
	
	$friendships = Friendship::where ('status', 0)
								->where('requested', $this->id)
								->get();
								
	foreach($friendships as $friendship):
		
		array_push($users, \App\User::find($friendship->requester));
	
	endforeach;
	
	return $users;
	}
	
	public function pending_friend_requests_ids()
	{
	return collect($this->pending_friend_requests())->pluck('id');
	}
	
	public function has_pending_friend_requests_from($user_id)
	{
			if(in_array($user_id, $this->pending_friend_requests_ids()->toArray()))
			{
				return 1;	
			}
			else
			{
				return 0;
			}
	}
	
	
	public function pending_friend_requests_sent()
	{
			$users = array();
			
			$friendships = Friendship::where('status', 0)
										->where('requester', $this->id)
										->get();
			foreach($friendships as $friendship):
			array_push($users, \App\User::find($friendship->requested));
			endforeach;
			return $users;
	}
	public function pending_friend_requests_sent_id()
	{
	return collect($this->pending_friend_requests_sent())->pluck('id');
	}
	
	
	
	public function has_pending_friend_requests_sent_to($user_id)
	{
			if(in_array($user_id, $this->pending_friend_requests_sent_id()->toArray()))
			{
				return 1;	
			}
			else
			{
				return 0;
			}
	}
	
}