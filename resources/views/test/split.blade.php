@extends('master')
@section('content')
<pre>
	{{$res}}
</pre>
api url : /v1/users/{id}/tickets/{user_ticket_id}/split <br><br><br>
<form class="action-form" id="action-form" method="post" action="/test-split-ticket">
<label>User ID param</label>
<input type="text" name="param1">
<br>
<label>User Ticket ID param</label>
<input type="text" name="param2">
<br>
<label>Adult Num</label>
<input type="text" name="adult_num">
<br>
<label>Child Num</label>
<input type="text" name="child_num">
<br>
<input type="submit" class="form-submit" value="Submit" id="post-submit" name="search"/>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

@endsection