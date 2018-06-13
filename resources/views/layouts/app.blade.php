<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	 <title>{{config('app.name')}}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	
	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">

  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
	
	<style>
	.panel-body{
	background:#eee	
		
	}
	
	.post_file_container video, .post_file_container img{
		border-radius: 10px;
		
	}
	.panel {
    width:70%;
    }
	
	body {
		
	background: #e5e5e5;	
		
	}
	div {
		
		
		
	}
	#avatar {
	border: 1px solid #fff;
	box-shadow: 1px 1px 2px 1px #ccc;
	position :relative;
	
	}
	.post_avatar {
	position: relative;
	top: -5px;

    }
	
	.stick-nav{
	
	position: fixed;
	top:0px;
	background:rgb(0, 51, 0);
	width:100%;
	height:45px;
	padding:0px;
	
	z-index:3;
		
	}
	
	.profile-heading {
	width:825px;
	height:45px;
	background:#eee;
	border-top: 10px solid rgb(0, 51, 0);
	position: relative;
	left: -120px;
		
	}
	
	.profile-avatar{
		position: relative;
		top: -55px;
		left:32px;
		
		
	}
	.nav_right{
	position:relative;
	top:10px;
	left:730px;
		
	}
	.nav_right a{
		
		color:#fff;
		font-weight:bold;
		height:40px;
		padding-top:-10px;
		padding-bottom:10px;
		text-decoration:none;
		margin:10px;
		margin-top:100px;
		padding:5px;
	}
	
	.nav_right a:hover{
		background: rgba(255,255,255,0.2)
		
	}
	
	
	
	.navbar-right a:hover{
	color:#000;
	background:#000;
	
		
	}
	.feed_position, .login-container{
	position:absolute;
	top:70px;
	left: 50px;	
	}
	
	.stickyvideo{
		width:250px;
		height:500px;
		position:fixed;
		top:70px;
		left: 800px;
		
		
	}
	
	
	.left_bar_position{
	position: fixed;
	top:60px;
	left:100px;
	width:auto;
	height:auto;	
		
	}
	
	.right_bar_position{
	position: fixed;
	top:45px;
	left:1150px;
	width:auto;
	min-height:1200px;
	border-left: 1px solid #ccc;
	padding-left:10px;
	padding-top:15px
	
		
	}
	
	.center_bar_position{
	position: fixed;
	top:60px;
	left:820px;
	width:auto;
	height:auto;	
		
	}
	
	.dropdown-menu {
	position:fixed;	
	top:43px;
	left:900px;	
	}
	.dropdown-menu a{
	width:40px;
	color: rgba(0,0,0,0.5);	
	margin:10px;
	margin-left:20px;
	padding-right:30px;
		
	}
	
	
	.dropdown-menu a:hover{
	
	background: rgba(0,0,0,0.1);
    
		
	}
	
	.post_button {
background:rgb(0, 51, 0);
border:none;
border-radius: 5%;
color:#fff;
font-weight:bold;

}

.post_button:hover{
background: rgba(0, 51, 0, 0.9);
}

.top-container{
			   position: absolute;
			   top: 0px;
			   left:0px;
			   width: 100%;
			   height: 150px;
			   background-color:rgb(0,51,0);
			   
				
			}
			
.bottom-container{
			   position: absolute;
			   top: 150px;
			   left:0px;
			   width: 100%;
			   height: 450px;
			   background-color:#fff;
			   
				
			}
			
			
			
.top-right {
                position: absolute;
                right: 10px;
                top: 14px;
				
            }
			
.links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
				z-index: 1;
            }
	
	
	
	
	
	</style>
	
</head>
<body>

    <div id="app">
	
	<init></init>
	
		 
        <div class="stick-nav">
            <div class="container">
			

               <div class="top-right links">
            @if (Route::has('login'))
				
                    @if (Auth::check())
                        
                    @else
						<a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
				
            @endif
				
					
                   
                    <!-- Right Side Of Navbar -->
				<div class="nav_right">	
                    
					@if (Auth::check())
						<a href="{{ url('/home') }}">
                         Home
						 </a>
						<!-- 
                        <a href="{{route('profile', ['slug' => Auth::User()->slug])}}">My Profile</a>
						-->
						<unread></unread>
                    @endif
					

                   
                   
                        <!-- Authentication Links -->
                        @if (Auth::guest())
							
                        @else
                            <span class="dropdown">
                                
								
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   <img src="{{ Auth::user()->avatar }}" width="20px" height="20px"  style="border-radius:50%;" alt="" /> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <span class="dropdown-menu" role="menu">
                                    <p>
									<a href="{{route('profile', ['slug' => Auth::User()->slug])}}"> <img src="{{ Auth::user()->avatar }}" width="15px" height="15px"  style="border-radius:50%;" alt="" /> Profile</a>
									</p>
									<p>
									<a href="{{route('profile.edit')}}"><img src="http://localhost:8000/icons/settings_icon.png" width="15px" height="15px"  alt="" /> Settings</a>
									</p>
									<span>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                          <img src="http://localhost:8000/icons/logout_icon.png" width="15px" height="15px"  alt="" />  Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </span>
                                </span>
                            </span>
                        @endif
              
                </div>
            </div>
        </div>

        @yield('content')
		
		@if (Auth::check())
		<notification :id="{{Auth::id()}}"></notification>
		<audio id="noty_audio">
		<source src="{{asset('audio/notify.mp3')}}">
		</audio>
		@endif
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/notify.min.js') }}"></script>

	<script>
	@if(Session::has('success'))
    $.notify("{{Session::get('success')}}", { position:"right top" });  
   @endif
	</script>

</body>
</html>
