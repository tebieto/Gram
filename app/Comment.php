<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	
	public $with = ['user', 'likes'];
	protected $fillable = ['content', 'user_id', 'post_id'];
	
   	public function post() 
	
	{
		return $this ->belongsTo('App\Post');
	}
	
	public function user() 
	
	{
		return $this ->belongsTo('App\User');
	}
	
	public function likes() 
	
	{
		return $this ->hasMany('App\CommentLike');
	}
}
