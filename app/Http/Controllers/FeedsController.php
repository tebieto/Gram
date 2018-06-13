<?php

namespace App\Http\Controllers;
use Storage;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Like;
use App\Comment;
use App\Suggestion;
use Auth;
use DB;

class FeedsController extends Controller
{
	
	// This controller is the powerhouse of our news feed. Handle with care bro.
	
	
	public function allsuggestions()
	{
		$friends = Auth::user()->friends();
		$friends_id = collect($friends)->pluck('id')->toArray();
		$followings = Auth::user()->following();
		$followings_id = collect($followings)->pluck('id')->toArray();
		$suggested = array();
		
		
		
		$suggestions= Suggestion::orderBy(DB::raw('RAND()'))->get();
			
			foreach ($suggestions as $suggestion):
			if((Auth::id() != $suggestion->user_id) && !in_array($suggestion->user_id, $friends_id) && !in_array($suggestion->user_id, $followings_id)) {
				$user= User::where('id', $suggestion->user_id)
				->orderBy('created_at', 'DESC')->first();
				if (!in_array($user, $suggested)) {
				array_push($suggested, $user);
				}
				}
			endforeach;
		
		$suggested = array_slice($suggested, 0, 3);
		
		return $suggested;
	}
	
	
	 public function suggestions()
	{
		$friends = Auth::user()->friends();
		$friends_id = collect($friends)->pluck('id')->toArray();
		$followings = Auth::user()->following();
		$followings_id = collect($followings)->pluck('id')->toArray();
		$suggested = array();
		
		foreach($friends as $friend):
		
		$suggestions= Suggestion::where('auth_id', $friend->id)
				->orderBy(DB::raw('RAND()'))->get();
			
			foreach ($suggestions as $suggestion):
			if((Auth::id() != $suggestion->user_id) && !in_array($suggestion->user_id, $friends_id) && !in_array($suggestion->user_id, $followings_id)) {
				$user= User::where('id', $suggestion->user_id)
				->orderBy('created_at', 'DESC')->first();
				if (!in_array($user, $suggested)) {
				array_push($suggested, $user);
				}
				}
			endforeach;
		endforeach;
		
		
		foreach($followings as $following):
			$suggestions= Suggestion::where('auth_id', $following->id)
				->orderBy('created_at', 'DESC')->get();
			
			foreach ($suggestions as $suggestion):
				if((Auth::id() != $suggestion->user_id) && !in_array($suggestion->user_id, $friends_id) && !in_array($suggestion->user_id, $followings_id)) {
				$user= User::where('id', $suggestion->user_id)
				->orderBy('created_at', 'DESC')->first();
				if (!in_array($user, $suggested)) {
				array_push($suggested, $user);
				}
				}
			endforeach;
		endforeach;
		
		$suggested = array_slice($suggested, 0, 3);
		
		return $suggested;
	}
	
	
    public function feeds($start)
	{
		$friends = Auth::user()->friends();
		
		$feed = array();
		
		foreach($friends as $friend):
			foreach($friend->posts as $post):
			
				array_push($feed, $post);
			endforeach;
		endforeach;
		
		
		$followings = Auth::user()->following();
		
		foreach($followings as $following):
			foreach($following->posts as $post):
			
				array_push($feed, $post);
			endforeach;
		endforeach;
		
		foreach (Auth::user()->posts as $post):
		
		array_push($feed, $post);
		
		endforeach;
		
		usort($feed, function($a, $b) {
			
			return $b->created_at > $a->created_at;
			
		});
		
		$feed = array_slice($feed, $start, 5);
		
		return $feed;
	}
	
	public function feed()
	{
		
		$feed = array();
		
		$post = Post::where('user_id', Auth::id())
				->orderBy('created_at', 'DESC')->first();
		
		array_push($feed, $post);
		
		return $feed;
	}
	
	
	public function favouriteFeed($start)
	{
		$feed = array();
		
		$favourites = Like::where('user_id', Auth::id())
				->orderBy('created_at', 'DESC')->skip($start)->take(5)->get();
		
		
		
		foreach($favourites as $favourite):

		$post = Post::where('id', $favourite->post_id)
				->orderBy('created_at', 'DESC')->first();
				
		array_push($feed, $post);
		
		endforeach;
		
		return $feed;
	}
	
	
	public function newsFeed($start)
	{
		$feed = array();
		
		$posts = Post::orderBy('created_at', 'DESC')->skip($start)->take(5)->get();
		
		
		
		foreach($posts as $post):

				
		array_push($feed, $post);
		
		endforeach;
		
		return $feed;
	}
	
	
	public function profileFeed($id, $start)
	{
		
		$feed = array();
		
		$user = User::where('id', $id)
				->orderBy('created_at', 'DESC')->first();
		
		foreach ($user->posts as $post):
		
		array_push($feed, $post);
		
		endforeach;
		
		usort($feed, function($a, $b) {
			
			return $b->created_at > $a->created_at;
			
		});
		
		$feed = array_slice($feed, $start, 5);
		
		return $feed;
	}
	
		public function newcomment($id)
	{
		
		$comment = array();
		
		$new = Comment::where('user_id', Auth::id())
				->where('post_id', $id)
				->orderBy('created_at', 'DESC')->first();
		
		array_push($comment, $new);
		
		return $comment;
	}
	/*
	// I dont know the usefullness of this code right now. I did not even declare any feed array.
	
	public function people()
	{	
	$post = Post::where(status, 0)
				->orderBy('created_at', 'DESC')->first();
		
		array_push($feed, $post);
	}
	*/
	
	public function image(Request $request)
	{
		
		// This class process an uploaded image and returns a valid URL
		
		
		$image= $request->img;
		
		
		
		$ext = $image->extension();
		
		
		if ($ext== 'jpg' || $ext== 'jpeg' || $ext == 'png' || $ext == 'gif') {
			$type = 'image';
			
			//  we save the image in image folder
			
			$link = $image->store('public/images');
		} else {
			
			// If the user mistakenly upload a video instead of an image we save the video in video folder
			$type = 'video';
			$link = $image->store('public/videos');
		}
		
		if ($ext!= 'jpg' && $ext!= 'jpeg' && $ext != 'png' && $ext != 'gif' && $ext != '3gp' && $ext != 'ogg' && $ext != 'mp4' && $ext != 'webm' && $ext != 'avi' && $ext != 'flv' && $ext != 'wmv' && $ext != 'mov' ) {
			// If file format is not acceptable, we delete the file
			
			Storage::delete($link);
			
			// we return false instead of a valid URL
			
			return 0;
			
		}
		
	// If every thing goes well, we return a valid URL.
	
	return response(['URL'=>asset(Storage::url($link)), 'link'=>$link, 'type' => $type, 'ext' => $ext, 'mime' => $type .'/'. $ext]);
		
		
	}
	
	
	public function video(Request $request)
	{
		$video= $request->vid;
		
		
		$ext = $video->extension();
		
		if ($ext== 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif') {
			$type = 'image';
			$link = $video->store('public/images');
		} else {
			$type = 'video';
			$link = $video->store('public/videos');
		}
		
		if ($ext!= 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif' && $ext != '3gp' && $ext != 'ogg' && $ext != 'mp4' && $ext != 'webm' && $ext != 'avi' && $ext != 'flv' && $ext != 'wmv' && $ext != 'mov' ) {
			
			Storage::delete($link);
			
			return 0;
			
		}
		
		
	return response(['URL'=>asset(Storage::url($link)), 'link'=>$link, 'type' => $type, 'ext' => $ext, 'mime' => $type .'/'. $ext]);
		
		
	}
	
}
