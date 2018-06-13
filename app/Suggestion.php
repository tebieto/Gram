<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
	
    protected $fillable = ['user_id', 'auth_id'];
	
	public function user()
	
	{
		
	}
}
