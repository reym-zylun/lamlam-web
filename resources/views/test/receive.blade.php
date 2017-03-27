@extends('master')
@section('content')
<pre>
	{{$res}}
</pre>
api url : /v1/users/{user_id}/tickets/receive <br><br><br>
@if (count($errors) > 0)
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<form class="action-form" id="action-form" method="post" action="/test-receive-ticket">
<label>User ID param</label>
<input type="text" name="param1">
<br><br>
<label>Receive Key</label>
<input type="text" name="receive_key">
<br>
<input type="submit" class="form-submit" value="Submit" id="post-submit" name="search"/>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

</form>
@endsection