@extends('layouts.app')

@section('content')
<div class="feed_position">
<favourite-feed></favourite-feed>
</div>
<div class="left_bar_position">

<leftbar :id="{{auth::id()}}"></leftbar>

</div>
<!---
<div class="right_bar_position">

<rightbar></rightbar>

</div>
-->

<div class="center_bar_position">

<centerbar></centerbar>

</div>
@endsection
