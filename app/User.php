<?php

namespace App;

use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Storage;
class User extends Authenticatable
{
    use Notifiable;
	use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	 
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'avatar', 'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	
    protected $hidden = [
        'password', 'remember_token', 
    ];
	
	public function profile()
	{
			return $this->hasOne('App\profile');
		
	}
	
	public function posts()
	
	{
		return $this->hasMany('App\Post');
		
	}
	
	
	public function files()
	
	{
		return $this->hasMany('App\Files');
		
	}
	
	
	
	
}
