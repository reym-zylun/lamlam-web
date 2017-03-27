@extends('master')
@section('content')
<pre>
	{{$res}}
</pre>

<form class="action-form" id="action-form" method="post" action="/test-purchase-ticket">
<label>User ID param</label>
<input type="text" name="param1">
<br>
<label>Tickets</label>
<select id="ticket_id" class="form-select" name="ticket_id">
@foreach($tickets as $ticket)
<option value="{{$ticket->id}}">{{$ticket->name}}</option>
@endforeach
</select>
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