@extends('master')
@section('content')

<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.my-ticket') }}</li>
</ul><!-- End of .breadCrumb-->

<section id="myTicket">
    <div class="mainWrap">
        <div class="pageTitle">{{ trans('custom.title.my-ticket') }}<a href="/users/{{ $user_id }}/tickets/receive" class="btnDefault addTicket-btn"><span class="fa fa-plus"></span>{{ trans('custom.title.ticket-receive') }}</a></div>
        @foreach($usertickets->user_tickets as $k => $v)
            <div class="myTicketWrap hover{{ ucfirst($v->color) }}">
                <div class="myTicketBox">
                    <div class="myTicketThumbnail">
                        <div class="myTicketTitle">{{ $v->name }}</div>
                        <img class="spOnly" src="{{ $v->image_url}}" alt="{{ $v->name }}" width="70">
                        <img src="{{ $v->image_url }}" alt="{{ $v->name }}"/>
                    </div>

                    <div class="myTicketInfoWrap">
                        <div class="paxBox">
                            <h3 class="numPax">{{ $v->child_num + $v->adult_num }}<small>PAX</small></h3>
                        </div>
                        <div class="myTicketPassengers">
                            <span>{{ trans('custom.adult') }}: <strong id="adult{{ $v->id }}">{{ $v->adult_num }}{{ trans_choice('custom.sheet', $v->adult_num) }}</strong></span>
                            <span>{{ trans('custom.child') }}: <strong id="child{{ $v->id }}">{{ $v->child_num }}{{ trans_choice('custom.sheet', $v->child_num) }}</strong></span>
                        </div>
                        <div class="myTicketStatus">
                            @if (is_unused_ticket($v))
                                <strong>{{ trans('custom.unused') }}</strong><br />
                            @elseif (is_inuse_ticket($v))
                                Valid Through: <strong>@datetime($v->expired_date)</strong><br />
                            @else
                                <strong>{{ trans('custom.used') }}</strong><br />
                            @endif

                            @if(is_null($v->purchase_date))
                                Received Date: <strong>@datetime($v->received_date)</strong>
                            @else
                                Purchased On: <strong>@datetime($v->purchase_date)</strong>
                            @endif
                        </div>
                        <div class="myTicketButtons">
                            @if (is_unused_ticket($v))
                                <button class="useTicket-btn" data-id="{{ $v->id }}">{{ trans('custom.use') }}</button>
                            @else
                                <button class="useTicket-btn disabled">{{ trans('custom.use') }}</button>
                            @endif
                            @if (is_unused_ticket($v) || is_inuse_ticket($v))
                                <button class="splitTicket-btn" data-toggle="modal" data-id="{{ $v->id }}" data-adult-num="{{ $v->adult_num }}" data-child-num="{{ $v->child_num }}">{{ trans('custom.split') }}</button>
                            @else
                                <button class="splitTicket-btn disabled">{{ trans('custom.split') }}</button>
                            @endif
                            <button class="detailTicket-btn" data-id="{{ $v->id }}">{{ trans('custom.details') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @include('modals.split-ticket')
        @include('modals.use-ticket')
    </div>
</section>
<!-- End of #myTicket -->
@endsection
@section('script')
<!-- Modal Vertical Alignment -->
<script type="text/javascript">
$(document).ready(function(){
    function alignModal(){
        var modalDialog = $(this).find(".modal-dialog");

        // Applying the top margin on modal dialog to align it vertically center
        modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
    }
    // Align modal when it is displayed
    $(".modal").on("shown.bs.modal", alignModal);

    // Align modal when user resize the window
    $(window).on("resize", function(){
        $(".modal:visible").each(alignModal);
    });
});
$('.myTicketButtons .useTicket-btn').click(function(){
    var id = $(this).data('id');
    var adultVal = $("#adult" + id).html();
    var childVal = $("#child" + id).html();
    $('#use-ticket1 form').attr("action", "/users/{{ $user_id }}/tickets/" + id + "/use");
    $("#use-ticket1 #use-adult").html(adultVal);
    $("#use-ticket1 #use-child").html(childVal);
    $("#use-ticket1").modal({
        keyboard: false,
        backdrop: "static",
    });
});
$('.myTicketButtons .splitTicket-btn').click(function(){
    var id = $(this).data('id');
    var adultNum = $(this).data('adult-num');
    var childNum = $(this).data('child-num');
    $('#split-ticket1 form').attr("action", "/users/{{ $user_id }}/tickets/" + id + "/split");
    $('#split-ticket1 #adult > option').remove();
    for(var i = 0; i <= adultNum; i++){
        $("#split-ticket1 #adult").append($('<option>').html(i));
    }
    $('#split-ticket1 #children > option').remove();
    for(var i = 0; i <= childNum; i++){
        $("#split-ticket1 #children").append($('<option>').html(i));
    }
    $("#split-ticket1").modal({
        keyboard: false,
        backdrop: "static",
    });
});
$('.myTicketButtons .detailTicket-btn').click(function(){
    var id = $(this).data('id');
    location.href="/users/{{ $user_id }}/tickets/" + id;
});
</script>
@endsection
