@extends('layouts.app')


@section('content')

<div class="feed_position">
<div class="container ">
	<profile-header :avatar="'{{$user->avatar}}'" :slug="'{{$user->slug}}'":id="'{{$user->id}}'" :name="'{{$user->name}}'"></profile-header>
</div>
<profile-feed :id="'{{$user->id}}'"></profile-feed>

<!--
<div class="right_bar_position">

<rightbar></rightbar>

</div>

-->

<div class="center_bar_position">

<centerbar></centerbar>

</div>

</div>
@stop