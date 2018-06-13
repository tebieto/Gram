<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	
	 public function favourite()
    {
        return view('favourite');
    }
	
	 public function newsFeed()
    {
        return view('newsfeed');
    }
	
	public function notifications()
    {
       
		return view('nots');
		
    }
	
	public function allnotifications($slice)
    {
        Auth::user()->unreadNotifications->markAsRead();
		return Auth::user()->notifications->take($slice);
		
    }
	
	public function marknotifications()
    {	
		Auth::user()->unreadNotifications->markAsRead();
	
    }
}
