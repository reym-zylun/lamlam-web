@extends('master')
@section('content')

<div class="mainWrap">
    <div class="login-card">
        <div id="logoBox">
            <a href="/"><h1>LAMLAM TOURS & TRANSPORTATION</h1></a>
        </div>
        <br>
        <form method="POST" action="/auth/login">
            @include('error-message')
            {{-- CSRF対策--}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" class="login-btn">Login</button>
        </form>

        <span class="notMember">Not a member? <a href="/users/regist">Click here!</a></span><br />
        <span class="notMember">Forgot Your Password? <a href="/password">Click here!</a></span>
     </div>
</div>
@endsection
