@extends('layouts.app')

@section('content')

<div class="container brown-fox">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 feed_position">
            <div class="panel panel-default">
                <div class="panel-heading">Edit your profile</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                  <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
					  {{csrf_field()}}
					  <div class="form-group">
						
						
						<center>
			
							<img src="{{$used->avatar}}" width="70px" height="70px" style="border-radius: 50%;" alt="" title="{{$used->name}}"/>
			
						</center>
			
						<label for="location">Upload Avatar</label>
						<input type="file" name="avatar" class="form-control" accept="image/*">
					  </div>
					  
					  <div class="form-group">
						<label for="location">Location</label>
						<input type="text" name="location" value="{{$info->location}}" class="form-control" required>
					  </div>
					  
					  <div class="form-group">
						<label for="location">About me</label>
						<textarea type="text" id="about" name="about" cols="30" rows="10" class="form-control" required>{{$info->about}}</textarea>
					  </div>
					  
					  <div class="form-group">
						<p class="text-center">
						<button type="submit" class="btn btn-primary btn-lg">
						Save your information
						</button>
						</p>
					  </div>
					  
				   </form>
				   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
