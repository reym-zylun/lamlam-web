@extends('admin.master')
@section('admin.content')
<div class="col-md-12">
    <div class="row">
        <div class="btn-group" style="margin-bottom: 15px;">
            <a href="{{route('admin.tickets')}}" type="button" class="btn {{ !app('request')->input('status') ? 'btn-primary' : 'btn-default'}}">All</a>
            <a href="?status=purchase" type="button" class="btn {{ (app('request')->input('status')&&app('request')->input('status')=='purchase') ? 'btn-primary' : 'btn-default'}}" >Purchase</a>
            <a href="?status=no-purchase" type="button" class="btn {{ (app('request')->input('status')&&app('request')->input('status')=='no-purchase') ? 'btn-primary' : 'btn-default'}}">No Purchase</a>
            <a href="?status=recommend" type="button" class="btn {{ (app('request')->input('status')&&app('request')->input('status')=='recommend') ? 'btn-primary' : 'btn-default'}}" >Recommended</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <form method="GET" action="{{ route('admin.tickets') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ticket &hellip;" name="search"
                            value="@if (isset($prev_search['search'])){{$prev_search['search']}}@endif">
                            <span class="input-group-btn">
                                <button id="ticket-search" type="submit" class="btn btn-default">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <a class="btn btn-default pull-right" data-toggle="modal" data-target="#ticket-register-modal">Add New</a>
                </div>
            </div>
        </div>
        <br>
    </div>
    @if(count($tickets)>0)
	    @foreach($tickets as $key => $ticket)
	    <div class="col-md-12">
	    	<div class="row">
			   <ul class="list-group">
				    <li>
				        <div class="panel panel-default">
				            <div class="panel-body">
				                <div class="col-md-6">
				                    <div class="panel-info">
				                        <p class="pull-left"><strong>{{ $ticket->name }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $ticket->description }}</p><br>
				                    </div>
				                </div>
						        <div class="col-md-6">
						            <div class="view-detail-btn pull-right">
				                        <a class="btn btn-default" data-toggle="modal" data-target="#view-ticket-modal" id="{{$ticket->id}}">View / Edit</a>
				                    </div>
						        </div>
				            </div>
				        </div>
				  </li>
				</ul>
	    	</div>
	    </div>
	    @endforeach

        @include('admin.pagination', ['route'=>'tickets','pagination' => $pagination])
        
	@else
    <div class="col-md-12">
    	<div class="row">
		   <ul class="list-group">
			    <li>
			        <div class="panel panel-default">
			            <div class="panel-body">
			                No Tickets
			            </div>
			        </div>
			  </li>
			</ul>
    	</div>
    </div>    
    @endif
</div>
<!-- modal -->
@include('admin.tickets.register-modal')
@include('admin.tickets.show')
@include('admin.tickets.modal-fail')
@include('admin.tickets.modal-success')
@include('admin.tickets.modal-prompt-delete')
@include('admin.tickets.modal-success-delete')

<script type="text/javascript">$(window).load(function(){LAMLAM.tickets()})</script>

@endsection