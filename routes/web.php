<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
Use App\User;

Route::get('/', function () {
	 if(Auth::check()){
    return view('home');
	 } else {
		 
	 return view('welcome'); 
	 }
});

Route::get('/add', function () {
    return \App\User::find(2)->add_friend(4);
});

Route::get('/accept', function () {
    return \App\User::find(6)->accept_friend(3);
});

Route::get('/friends', function () {
    return \App\User::find(6)->friends();
});

Route::get('/friends_ids', function () {
    return \App\User::find(6)->friends_ids();
});

Route::get('/myfriend', function () {
    return \App\User::find(6)->is_friends_with(2);
});

Route::get('/isent', function () {
    return \App\User::find(3)->has_pending_friend_requests_sent_to(6);
});

Route::get('/ireceived', function () {
    return \App\User::find(6)->has_pending_friend_requests_from(4);
});

Route::get('/pending_requests', function () {
    return \App\User::find(6)->pending_friend_requests();
});

Route::get('/check_relationship_status/{id}', [
'uses' => 'FriendshipController@check',
'as' => 'check'
]);

Route::get('/add_friend/{id}', [
'uses' => 'FriendshipController@add_friend',
'as' => 'add_friend'
]);

Route::get('/accept_friend/{id}', [
'uses' => 'FriendshipController@accept_friend',
'as' => 'accept_friend'
]);

Route::get('/get_unread', function () {
    return Auth::user()->unreadNotifications;
});

Route::get('/auth/friends', function () {
    return Auth::user()->friends();
});

Route::get('/auth/followers', function () {
    return Auth::user()->followers();
});

Route::get('/auth/following', function () {
    return Auth::user()->following();
});

Route::get('/user/{id}/friends/{start}', function ($id, $start) {
	$feed= array();
	$user = User::where('id', $id)
				->orderBy('created_at', 'DESC')->first();
    $friends= $user->friends();
	foreach($friends as $friend):
	array_push($feed, $friend);
	endforeach;
	return array_slice($feed, $start, 12);
});

Route::get('/user/{id}/following/{start}', function ($id, $start) {
	$feed= array();
	$user = User::where('id', $id)
				->orderBy('created_at', 'DESC')->first();
   $followings= $user->following();
	foreach($followings as $following):
	array_push($feed, $following);
	endforeach;
	return array_slice($feed, $start, 12);
});

Route::get('/user/{id}/followers/{start}', function ($id, $start) {
	$feed= array();
	$user = User::where('id', $id)
				->orderBy('created_at', 'DESC')->first();
    $followers= $user->followers();
	foreach($followers as $follower):
	array_push($feed, $follower);
	endforeach;
	return array_slice($feed, $start, 12);
});

Route::get('/user/{id}/friends/', function ($id) {
	$feed= array();
	$user = User::where('id', $id)
				->orderBy('created_at', 'DESC')->first();
    $friends= $user->friends();
	foreach($friends as $friend):
	array_push($feed, $friends);
	endforeach;
	return $feed;
});

Route::get('/user/{id}/following', function ($id) {
	$feed= array();
	$user = User::where('id', $id)
				->orderBy('created_at', 'DESC')->first();
   $followings= $user->following();
	foreach($followings as $following):
	array_push($feed, $following);
	endforeach;
	return $feed;
});

Route::get('/user/{id}/followers/', function ($id) {
	$feed= array();
	$user = User::where('id', $id)
				->orderBy('created_at', 'DESC')->first();
    $followers= $user->followers();
	foreach($followers as $follower):
	array_push($feed, $follower);
	endforeach;
	return $feed;
});


Route::get('/friends/{slug}', [
   'uses' => 'FriendshipController@allfriends',
    'as' => 'allfriends'
]);


Route::get('/followers/{slug}', [
   'uses' => 'FriendshipController@allfollowers',
    'as' => 'allfollowers'
]);

Route::get('/following/{slug}', [
   'uses' => 'FriendshipController@allfollowing',
    'as' => 'allfollowing'
]);




Route::get('/get_all_nots/{slice}', [
   'uses' => 'HomeController@allnotifications',
    'as' => 'allnotifications'
]);

Route::get('/get_auth_user_data', function () {
    return Auth::user();
});

Route::get('/notifications', [
'uses' => 'HomeController@notifications',
'as' => 'notifications'
]);

Route::get('/mark/notifications', [
'uses' => 'HomeController@marknotifications',
'as' => 'marknotifications'
]);

Route::get('/feeds/{start}', [
'uses' => 'FeedsController@feeds',
'as' => 'feed'
]);

Route::get('/favourite', [
   'uses' => 'HomeController@favourite',
    'as' => 'favourite'
]);
Route::get('/feeds/favourite/{start}', [
'uses' => 'FeedsController@favouriteFeed',
'as' => 'favouriteFeed'
]);

Route::get('/newsfeed', [
   'uses' => 'HomeController@newsFeed',
    'as' => 'getnewsfeed'
]);
Route::get('/feeds/newsfeed/{start}', [
'uses' => 'FeedsController@newsFeed',
'as' => 'newsFeed'
]);


Route::get('/user/suggestions', [
'uses' => 'FeedsController@suggestions',
'as' => 'suggestions'
]);

Route::get('/all/suggestions', [
'uses' => 'FeedsController@allsuggestions',
'as' => 'allsuggestions'
]);

Route::get('/today', [
'uses' => 'FeedsController@today',
'as' => 'today'
]);

Route::get('/feed', [
'uses' => 'FeedsController@feed',
'as' => 'feed'
]);


Route::get('/new/comment/{id}', [
'uses' => 'FeedsController@newcomment',
'as' => 'newcomment'
]);

Route::get('/suggest/{id}', [
'uses' => 'LikesController@suggest',
'as' => 'Suggest'
]);

Route::get('/like/{id}', [
'uses' => 'LikesController@like',
'as' => 'Like'
]);


Route::get('/unlike/{id}', [
'uses' => 'LikesController@unlike',
'as' => 'Unlike'
]);

Route::get('/add/{id}/{ext}/public/images/{url}', [
'uses' => 'PostsController@imageSaver',
'as' => 'imageSaver'
]);

Route::get('/add/{id}/{ext}/public/videos/{url}', [
'uses' => 'PostsController@videoSaver',
'as' => 'videoSaver'
]);

Route::post('/create/post', [
'uses' => 'PostsController@store',
'as' => 'posts'
]);

Route::post('/add/comment', [
'uses' => 'PostsController@comment',
'as' => 'comments'
]);

Route::post('/upload/video', [
	'uses' => 'FeedsController@video',
	'as' => 'video'
	]);

Route::post('/upload/image', [
	'uses' => 'FeedsController@image',
	'as' => 'image'
	]);




Auth::routes();

Route::get('/fb/auth/redirect', 'SocialController@redirect');
Route::get('/fb/auth/callback', 'SocialController@callback');


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function (){
	Route::get('/profile/{slug}', [
	'uses' => 'ProfilesController@index',
	'as' => 'profile'
	]);
	
	Route::get('/user/profile/{slug}', [
	'uses' => 'ProfilesController@profile',
	'as' => 'uprofile'
	]);
	
	Route::get('/feed/profile/{id}/{start}', [
	'uses' => 'FeedsController@profileFeed',
	'as' => 'profileFeed'
	]);
	
	Route::get('/avatar/{slug}', [
	'uses' => 'ProfilesController@avatar',
	'as' => 'avatar'
	]);
	
	Route::get('/profile/edit/profile', [
	'uses' => 'ProfilesController@edit',
	'as' => 'profile.edit'
	]);
	
	Route::post('/profile/update/profile', [
	'uses' => 'ProfilesController@update',
	'as' => 'profile.update'
	]);
});