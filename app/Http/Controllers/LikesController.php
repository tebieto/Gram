<?php

namespace App\Http\Controllers;
use Auth;
use App\Post;
use App\Like;
use App\User;
use App\Suggestion;
use Illuminate\Http\Request;



class LikesController extends Controller
{
	
	
	public function suggest($id)
	
	{
		if ($id == Auth::id()) {
		return 0;		
		}
		
		$suggest = Suggestion::where('auth_id', Auth::id())
		->where('user_id', $id)
		->first();
		
		if(empty($suggest)) {
		
		$suggest = Suggestion::create([
			
			'auth_id' => Auth::id(),
			
			'user_id' => $id
		]);
		
		return Suggestion::find($suggest->id);
		}
		
		return 0;
		
	}
	
    public function like($id)
	
	{
		$post = Post::find($id);
		
		$like = Like::where('user_id', Auth::id())
		->where('post_id', $post->id)
		->first();
		
		if(empty($like)) {
		
		$like = Like::create([
			
			'user_id' => Auth::id(),
			
			'post_id' => $post->id
		]);
		
		return Like::find($like->id);
		}
		
		return 0;
		
	}
	public function unlike($id)
	
	{
		$post = Post::find($id);
		
		$like = Like::where('user_id', Auth::id())
		->where('post_id', $post->id)
		->first();
		
		if(!empty($like)) {
		
		$like->delete();
		
		}
		
		return $like->id;
		
	}
	
}
