<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $with = ['user', 'likes', 'files', 'comments'];
	protected $fillable = ['content', 'user_id'];
	//Auth::user()->post()->create(['content']);
	
	public function user() 
	
	{
		return $this ->belongsTo('App\User');
	}
	
	public function likes() 
	
	{
		return $this ->hasMany('App\Like');
	}
	
	public function files() 
	
	{
		return $this ->hasMany('App\File');
	}
	
	public function comments() 
	
	{
		return $this ->hasMany('App\Comment');
	}
}
