@extends('admin.master')
@section('admin.content')
<script src="{{ asset('js/jquery-ui-timepicker-addon.js') }}"></script>
<link href="{{ asset('css/jquery-ui-timepicker-addon.css') }}" rel="stylesheet"> 
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <form method="GET" action="{{ route('admin.informations') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Information &hellip;" name="search"
                            value="@if (isset($prev_search['search'])){{$prev_search['search']}}@endif">
                            <span class="input-group-btn">
                                <button id="information-search" type="submit" class="btn btn-default">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <a class="btn btn-default btnOrder pull-right" data-toggle="modal" data-target="#information-register-modal">Add New</a>
                </div>
            </div>
        </div>
        <br>
    </div>
    @if(count($infos)>0)
        @foreach($infos as $key => $info)
        <div class="col-md-12">
            <div class="row">
                <ul class="list-group">
                    <li>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{!! nl2br($info->comments) !!}</strong></p><br>
                                </div>
                                <div class="col-md-2">
                                     <p class="text-center"><strong>{{ $info->open_date }}</strong></p><br>
                                </div>
                                <div class="col-md-2">
                                     <p class="text-center"><strong>{{ $info->close_date }}</strong></p><br>
                                </div>
                                <div class="col-md-2">
                                    <div class="view-detail-btn pull-right">
                                        <a class="btn btn-default btnOrder" data-toggle="modal" id="{{$info->id}}" data-target="#view-information-modal">View / Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </li>
                </ul>
            </div>
        </div>
        @endforeach

        @include('admin.pagination', ['route'=>'informations','pagination' => $pagination])

    @else
    <div class="col-md-12">
        <div class="row">
            <ul class="list-group">
                <li>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            No Informations
                        </div>
                    </div>
              </li>
            </ul>
        </div>
    </div>
    @endif
</div>
<!-- modal -->
@include('admin.informations.show')
@include('admin.informations.register-modal')
@include('admin.informations.modal-fail')
@include('admin.informations.modal-success')
@include('admin.informations.modal-prompt-delete')
@include('admin.informations.modal-success-delete')

<script type="text/javascript">$(window).load(function(){LAMLAM.informations()})</script>
@endsection
