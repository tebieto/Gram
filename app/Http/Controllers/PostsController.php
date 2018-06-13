<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\User;
use App\File;
Use Auth;
Use Session;
Use Storage;



use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function store (Request $request)
	{	
		$post = Post::create([
		'user_id' => Auth::id(),
		'content' => $request->content
		]);
		
		return ;
	}
	
	  public function comment (Request $request)
	{	
		$comment = Comment::create([
		'user_id' => Auth::id(),
		'content' => $request->content,
		'post_id' => $request->postid
		]);
		
		
		return ;
		
		
	}
	
	
	public function videoSaver($id, $ext, $url)
	
	{
		$post = Post::find($id);
		
		
		$url = 'public/videos/' . $url;
		
		$ext = $ext;
		
		$mime = 'video/' . $ext;
		$url = asset(Storage::url($url));
		
		$video = File::create([
			
			'user_id' => Auth::id(),
			
			'post_id' => $post->id,
			
			'mime' => $mime,
			'link' => $url,
			'ext' => $ext,
			'type' => 'video'
		]);
		
		return File::find($video->id);
		
		
	}
	
	public function imageSaver($id, $ext, $url)
	
	{
		$post = Post::find($id);
		
		$ext = $ext;
		
		$url = 'public/images/' . $url;
		
		$mime = 'image/' . $ext;
		$url = asset(Storage::url($url));
		$image = File::create([
			
			'user_id' => Auth::id(),
			
			'post_id' => $post->id,
			
			'link' => $url,
			
			'mime' => $mime,
			
			'ext' => $ext,
			
			'type' => 'image'
		]);
		
		return File::find($image->id);
		
		
	}
	
}
