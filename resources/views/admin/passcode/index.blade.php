@extends('admin.master')
@section('admin.content')
<script src="{{ asset('js/select2.min.js') }}"></script>
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery-ui-timepicker-addon.js') }}"></script>
<link href="{{ asset('css/jquery-ui-timepicker-addon.css') }}" rel="stylesheet"> 

<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <a class="btn btn-default pull-right" data-toggle="modal" data-target="#passcode-register-modal">Passcode Issue</a>
            </div>
        </div>
    </div>
    <br>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <form method="get" action="{{route('admin.passcodes')}}">
                <div class="col-xs-2">
                   <select name="issued_ticket_type" class="form-control">
                        @foreach(config('define.issued_ticket_type') as $type)
                            <option <?php echo app('request')->input('issued_ticket_type')==$type?"selected":false; ?> value="{{$type}}">{{$type}}</option>
                        @endforeach
                   </select>
                </div>
                <div class="col-xs-4">
                   <select name="ticket_id" id="ticket_id" class="form-control"></select>
                </div>
                <div class="col-xs-2">
                   <input type="text" class="form-control" name="from_date" id="from_date" value="{{$prev_from_date}}">
                </div>
                <div class="col-xs-2">
                   <input type="text" class="form-control" name="to_date" id="to_date" value="{{$prev_to_date}}">
                </div>
                <div class="col-xs-2">
                    <div class="view-detail-btn pull-right">
                        <button type="submit" class="btn btn-default">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2"><b>Issued {{$counters->issued}}</b></div>
            <div class="col-md-2"><b>Received {{$counters->receive}}</b></div>
            <div class="col-md-2"><b>Not Yet Received {{$counters->not_receive}}</b></div>
        </div>
        <br>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-2">
                        <div class="panel-info">
                        <b>Ticket Name</b>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <b>Number of Person</b>
                    </div>
                    <div class="col-md-3">
                        <b>Passcode</b>
                    </div>
                    <div class="col-md-2">
                        <b>Status</b>
                    </div>
                    <div class="col-md-2">
                        <b>Issued Date</b>
                    </div>
                    <div class="col-md-1">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($passcodes)>0)
	    @foreach($passcodes as $key => $passcode)
	    <div class="col-xs-12">
	    	<div class="row">
		        <div class="panel panel-default">
		            <div class="panel-body">
		                <div class="col-xs-2">
		                    <div class="panel-info">
		                            <p><strong>{{ $passcode->name }}</strong>
                            </div>
		                </div>
                        <div class="col-xs-2">
                           Adult&nbsp;&nbsp; {{ $passcode->adult_num }} <br>
                           Child&nbsp;&nbsp; {{ $passcode->child_num }}
                        </div>
                        <div class="col-xs-3">
                           {{ $passcode->receive_key }}
                        </div>
                        <div class="col-xs-2">
                            {{ is_null($passcode->user_ticket_id) ? 'Not Yet Received' : 'Received'}}
                            @if(!is_null($passcode->user_ticket_id))
                            <br>({{ $passcode->username }})
                            @endif
                        </div>
                        <div class="col-xs-2">
                            {{ $passcode->issued_date }}
                        </div>
				        <div class="col-xs-1">
				            <div class="view-detail-btn">
		                        <a class="btn btn-default pull-right" data-toggle="modal" data-target="#passcode-prompt-delete-modal" id="{{$passcode->id}}">Delete</a>
		                    </div>
				        </div>
		            </div>
		        </div>
	    	</div>
	    </div>
	    @endforeach

        @include('admin.pagination', ['route'=>'passcodes','pagination' => $pagination])
	    
	@else
    <div class="col-md-12">
    	<div class="row">
		   <ul class="list-group">
			    <li>
			        <div class="panel panel-default">
			            <div class="panel-body">
			                No Passcodes
			            </div>
			        </div>
			  </li>
			</ul>
    	</div>
    </div>    
    @endif
</div>

<!-- modal -->
@include('admin.passcode.modal-prompt-delete')
@include('admin.passcode.modal-success-delete')
@include('admin.passcode.register-modal')
@include('admin.passcode.modal-fail')
@include('admin.passcode.modal-success')
@include('admin.passcode.modal-prompt-issue')

<script type="text/javascript">
    var data             = JSON.parse(<?php echo json_encode($tickets) ?>);
    var from = $('#from_date');
    var to   = $('#to_date');

    $("#ticket_id").select2({
      data: data
    });
    $("#reg_ticket_id").select2({
      data: data
    });
    $('#ticket_id').select2('val',"{!! $prev_select !!}"); //set old input

    $.timepicker.datetimeRange(
        from,
        to,
        {
            minInterval: (1000*60*60), // 1hr
            timeFormat: "HH:mm:ss",
            dateFormat: "yy-mm-dd"
        }
    );
</script>
<script type="text/javascript">$(window).load(function(){LAMLAM.passcodes()})</script>
@endsection