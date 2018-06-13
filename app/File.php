<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	
	protected $fillable = ['user_id', 'post_id', 'link', 'type', 'mime', 'ext'];
    public function post() 
	
	{
		return $this ->belongsTo('App\Post');
	}
	
	public function user() 
	
	{
		return $this ->belongsTo('App\User');
	}
}
