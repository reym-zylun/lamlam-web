@extends('master')
@section('content')
<pre>
	{{$res}}
</pre>
api url : /v1/users/{id}/tickets/{user_ticket_id}/use <br><br><br>
<form class="action-form" id="action-form" method="post" action="/test-start-ticket">
<label>User ID param</label>
<input type="text" name="param1">
<br><br>
<label>User TicketID param</label>
<input type="text" name="param2">
<br><br>
<input type="submit" class="form-submit" value="Submit" id="post-submit" name="search"/>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
@endsection