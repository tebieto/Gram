@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit your profile</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                  <form action="{{route('profile.update')}}">
					  {{csrf_field()}}
					  <div class="form-group">
						<label for="location">Location</label>
						<input type="text" name="location" value="{{$info->location}}" class="form-control">
					  </div>
					  
					  <div class="form-group">
						<label for="location">About me</label>
						<textarea type="text" id="about" name="about" cols="30" rows="10" class="form-control">{{$info->location}}</textarea>
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
