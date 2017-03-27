@extends('admin.master')
@section('admin.content')
<script src="{{ asset('js/select2.min.js') }}"></script>
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery-ui-timepicker-addon.js') }}"></script>
<link href="{{ asset('css/jquery-ui-timepicker-addon.css') }}" rel="stylesheet"> 

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <form method="post" action="{{route('admin.sales')}}">
                <div class="col-xs-4">
                   <select name="ticket_id" id="ticket_id" class="form-control"></select>
                </div>
                <div class="col-xs-2">
                   <input type="text" class="form-control" name="from_date" id="from_date" value="{{$prev_from_date}}">
                </div>
                <div class="col-xs-2">
                   <input type="text" class="form-control" name="to_date" id="to_date" value="{{$prev_to_date}}">
                </div>
                <div class="col-xs-4">
                    <div class="view-detail-btn pull-right">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="_token" />
                        <button type="submit" class="btn btn-default">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
    </div>
        <div class="col-md-12">
            <div class="row">
               <ul class="list-group">
                    <li>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <p class="text-center"><strong>Name</strong></p>
                                </div>
                                <div class="col-md-2">
                                    <p class="text-center"><strong>Number of sales</strong></p>
                                </div>
                                <div class="col-md-2">
                                    <p class="text-center"><strong>Amount of sales</strong></p>
                                </div>
                                <div class="col-md-2">
                                    <p class="text-center"><strong>Number of cancel</strong></p>
                                </div>
                                <div class="col-md-2">
                                    <p class="text-center"><strong>Amount of cancel</strong></p>
                                </div>
                                <div class="col-md-2">
                                    <p class="text-center"><strong>Total</strong></p>
                                </div>
                            </div>
                        </div>
                  </li>
                </ul>
            </div>
        </div>
        @if(count($sales)>0)
        @foreach($sales as $key => $sale)
        <div class="col-md-12">
            <div class="row">
               <ul class="list-group">
                    <li>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <p class="text-center"><strong>{{ $sale->name }}</strong></p>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-1">
                                            <p class="text-left"><strong>Adult</strong></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-right">{{ $sale->adult_sales_num }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-1">
                                            <p class="text-left"><strong>Child</strong></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-right">{{ $sale->child_sales_num }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-1">
                                            <p class="text-left"><strong>Adult</strong></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-right">{{ $sale->adult_sales_amount }}$</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-1">
                                            <p class="text-left"><strong>Child</strong></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-right">{{ $sale->child_sales_amount }}$</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-1">
                                            <p class="text-left"><strong>Adult</strong></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-right">{{ $sale->adult_cancel_num }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-1">
                                            <p class="text-left"><strong>Child</strong></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-right">{{ $sale->child_cancel_num }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-1">
                                            <p class="text-left"><strong>Adult</strong></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-right">{{ $sale->adult_cancel_amount }}$</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-1">
                                            <p class="text-left"><strong>Child</strong></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-right">{{ $sale->child_cancel_amount }}$</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <p class="text-center"><strong>{{ $sale->total_amount }}$</strong></p><br>
                                </div>
                            </div>
                        </div>
                  </li>
                </ul>
            </div>
        </div>
        @endforeach
        
    @else
    <div class="col-md-12">
        <div class="row">
           <ul class="list-group">
                <li>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            No Sales
                        </div>
                    </div>
              </li>
            </ul>
        </div>
    </div>    
    @endif
</div>


<script type="text/javascript">
    var data             = JSON.parse(<?php echo json_encode($tickets) ?>);
    var from = $('#from_date');
    var to   = $('#to_date'); //set empty data on load

    $("#ticket_id").select2({
      allowClear: true,
      placeholder: "All Tickets or choose below",
      data: data
    });
    $('#ticket_id').select2('val'," ");
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
@endsection
