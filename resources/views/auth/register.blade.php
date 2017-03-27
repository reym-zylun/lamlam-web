@extends('master')
 
@section('content')
Register
@if (count($errors) > 0)
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
@endif
 
<form method="POST" action="/auth/register">
   {{-- CSRF対策--}}
   <input type="hidden" name="_token" value="{{ csrf_token() }}">

   <div>
     <label>Name</label>
     <div>
       <input type="text" name="name" value="{{ old('name') }}">
     </div>
   </div>
   <div >
     <label>E-Mail Address</label>
     <div>
       <input type="email" name="email" value="{{ old('email') }}">
     </div>
   </div>
   <div>
     <label>Confirm E-mail Address</label>
     <div>
       <input type="password" name="email_confirmation">
     </div>
   </div>
   <div>
     <div>
       <button type="submit">
         Register
       </button>
     </div>
   </div>
</form>
@endsection
