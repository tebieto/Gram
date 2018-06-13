<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
	
	public $with = ['user'];
	protected $fillable = ['comment_id', 'user_id'];
	
    public function user() 
	
	{
		return $this ->belongsTo('App\User');
	}
}
