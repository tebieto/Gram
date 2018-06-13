<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome to Padigram</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
			
			.custom-register-button a{
				
				text-decoration:none;
				font-weight:bold;
				background-color: rgb(0,51,0);
				color: #fff;
				padding: 10px;
				margin:5px;
				border-radius:25px;
				float:right;
			}
			
			.custom-login-button a{
				text-decoration:none;
				font-weight:bold;
				border: 1px solid rgb(0,51,0);
				color: rgb(0,51,0);
			
				padding: 10px;
				margin:5px;
				border-radius:25px;
				float:right;
			}
				

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 14px;
				
            }
			
			.top-container{
			   position: absolute;
			   top: 0px;
			   width: 100%;
			   height: 150px;
			   background-color:rgb(0,51,0);
				
			}
			
			.bottom-container{
			   position: absolute;
			   top: 512px;
			   width: 100%;
			   height: 150px;
			   background-color:#eee;
				
			}

            .content {
                text-align: center;
				margin:20px;
            }

            .title {
                font-size: 84px;
				font-weight:bold;
				color: rgb(0,51,0);
				
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
			
			.content span{
			color: #000;
			font-weight:bold;
				
			}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
		
			<div class="top-container"> </div>
			<div class="bottom-container"> </div>
			 <div class="top-right links">
            @if (Route::has('login'))
				
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
				
            @endif

            <div class="content">
                <div class="title">
                    Padigram
                </div>
				
				<div class="custom-button">
					
					<div class="custom-register-button">
						<a href="{{ url('/register') }}">Register</a>
					</div>
					<div class="custom-login-button">
					<a href="{{ url('/login') }}">Login</a>
					</div>
					
				</div>
				<span class="mantra">Na confirm friends dey here...</span>
			
            </div>
		
        </div>
		
    </body>
</html>
