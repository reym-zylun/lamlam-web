@extends('admin.master')
@section('admin.content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <form method="GET" action="{{ route('admin.users') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search User &hellip;" name="search"
                            value="@if (isset($prev_search['search'])){{$prev_search['search']}}@endif">
                            <span class="input-group-btn">
                                <button id="user-search" type="submit" class="btn btn-default">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
    @if(count($users)>0)
        @foreach($users as $key => $user)
        <div class="col-md-12">
            <div class="row">
               <ul class="list-group">
                    <li>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-1">
                                    <div class="panel-info">
                                        <strong>{{ $user->id }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{ $user->name }}
                                </div>
                                <div class="col-md-3">
                                    {{ $user->email }}
                                </div>
                                <div class="col-md-3">
                                    {{ ($user->email_magazine_subscribed) ? 'Subscribe' : 'Not Subscribe' }}
                                </div>
                                <div class="col-md-2">
                                    <div class="view-detail-btn pull-right">
                                        <a class="btn btn-default" data-toggle="modal" data-target="#edit-user-modal" id="{{$user->id}}">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </li>
                </ul>
            </div>
        </div>
        @endforeach

        <div class="col-md-12">
            <div class="row">
            @include('admin.pagination', ['route'=>'users','pagination' => $pagination])
            </div>
        </div>
    @else
    <div class="col-md-12">
        <div class="row">
           <ul class="list-group">
                <li>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            No Users
                        </div>
                    </div>
              </li>
            </ul>
        </div>
    </div>    
    @endif
</div>
<!-- modal -->
@include('admin.users.edit')
@include('admin.users.modal-prompt-edit')
@include('admin.users.modal-fail')
@include('admin.users.modal-success')
<script type="text/javascript">$(window).load(function(){LAMLAM.users()})</script>

@endsection