@extends('master')
@section('content')
<pre>
	{{$res}}
</pre>

<form class="action-form" id="action-form" method="post" action="/test-response">
<select id="actionList" class="form-select" name="selectsearch">
<option value="1">/v1/auth/refresh</option>
<option value="2">/v1/users/{user_id}/tickets</option>
<option value="3">/v1/users/{user_id}/tickets/{user_ticket_id}</option>
<option value="4">/v1/split_tickets/{receive_key}</option>
</select>
<input type="text" name="param1" id="param1" placeholder="param1">
<input type="text" name="param2" id="param2" placeholder="param2">
<input type="submit" class="form-submit" value="Submit" id="post-submit" name="search"/>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<script type="text/javascript">
	$( document ).ready(function() {
		$("#param1").hide();
		$("#param2").hide();

	    $("#actionList").change(function() {
		  if($(this).val() == "2") {
		  	$("#param1").show();
		  	$("#param2").hide();
		  }
		  else if($(this).val() == "3") {
		  	$("#param1").show();
		  	$("#param2").show();
		  }
		  else if($(this).val() == "4") {
		  	$("#param1").show();
		  	$("#param2").hide();
		  }
		  else {
		  	$("#param1").hide();
		  	$("#param2").hide();
		  }
		});
	});
</script>
@endsection