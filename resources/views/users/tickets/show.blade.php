@extends('master')
@section('content')

<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li><a href="/users/{{ $user_id }}/tickets">{{ trans('custom.title.my-ticket') }}</a></li>
    <li>{{ trans('custom.title.my-ticket-show') }}</li>
</ul><!-- End of .breadCrumb-->

<section class="mainWrap">
    <div class="msgArea @if (is_unused_ticket($userticket) || is_inuse_ticket($userticket)) hide @endif" id-msg="Expired"></div>
    <div id="ttlPassDetail">
        <img src="{{ $userticket->image_url }}" alt="{{ $userticket->name }}" width="120">
    </div>

    <div class="passDetailBox bg{{ ucfirst($userticket->color) }}">

        <section>
        <div class="passDetailInner">
            <div class="paxBox">
                <h3 class="numPax">{{ $userticket->child_num + $userticket->adult_num }}<small>PAX</small></h3>
            </div>
            <div class="numPersonnelBox">
                <dl>
                    <dt>{{ strtoupper(Lang::get('custom.adult',[],'en')) }}<span class="cologneBox">:</span></dt>
                    <dd><span class="numPerson">{{ $userticket->adult_num }}</span></dd>
                </dl>
                <dl>
                    <dt>{{ strtoupper(Lang::get('custom.child',[],'en')) }}<span class="cologneBox">:</span></dt>
                    <dd><span class="numPerson">{{ $userticket->child_num }}</span></dd>
                </dl>
            </div>
        </div><!-- End of .passDetailInner -->
        </section>

        <section>
        <div class="limitBox">
            @if ($userticket->type != config('define.ticket_type.time'))
                <h3>Valid Through</h3>
                @if (is_unused_ticket($userticket))
                <p class="time">{{ Lang::get('custom.unused',[],'en') }}</p>
                @elseif (is_inuse_ticket($userticket))
                <p class="time">@datetime($userticket->expired_date)</p>
                @else
                <p class="time">{{ Lang::get('custom.used',[],'en') }}</p>
                @endif
            @endif

            @if (is_inuse_ticket($userticket))
            <h3>Remaining time</h3>
            <p class="time" id="TimeLeft"></p>
            @endif

            @if(!is_null($userticket->purchase_date))
            <h3>Purchased on</h3>
            <p class="time">@datetime($userticket->purchase_date)</p>
            @elseif(!is_null($userticket->received_date))
            <h3>Issued on</h3>
            <p class="time">@datetime($userticket->received_date)</p>
            @endif

        </div>
        </section>

        @if (is_unused_ticket($userticket) || is_inuse_ticket($userticket))
        <section>
        <div class="splitTicket">
            <p><a class="btnSplit" data-toggle="modal" data-id="{{ $userticket->id }}" data-adult-num="{{ $userticket->adult_num }}" data-child-num="{{ $userticket->child_num }}">{{ trans('custom.split') }}</a></p>
            <p class="fs12 txtC">{{ trans('custom.split-caution') }}</p>
        </div>
        </section>
        @endif

    </div><!-- End of .passDetailBox -->
</section>

<section class="mainWrap">
    @if (count($userticket->split_tickets) > 0)
    <div class="splitTicketBox">
        <h4 class="ttlSplitTicketList">{{ trans('custom.split-history') }}</h4>
        @foreach($userticket->split_tickets as $k =>$v)
        <dl>
            <dt class="txtSplitDay">{{ date('Y.m.d H:i', strtotime($v->splitted_date)) }}</dt>
            <dd class="txtSplitPerson">ADULT : <span>{{ $v->adult_num }}</span>{{ trans_choice('custom.sheet', $v->adult_num) }}</dd>
            <dd class="txtSplitPerson">CHILD : <span>{{ $v->child_num }}</span>{{ trans_choice('custom.sheet', $v->child_num) }}</dd>
            <dd class="txtTicketNo">Ticket No : {{ $v->receive_key }}</dd>
        </dl>
        @endforeach
        @if (is_unused_ticket($userticket) || is_inuse_ticket($userticket))
            <div class="divisionBtnWrap">
                <span class="red" style="margin-right:15px; line-height: 15px;">{{ trans('custom.split-caution') }}</span><button type="button" data-toggle="modal" data-id="{{ $userticket->id }}" data-adult-num="{{ $userticket->adult_num }}" data-child-num="{{ $userticket->child_num }}" class="division-btn">{{ trans('custom.split') }}</button>
            </div>
        @endif
    @endif
    </div>
@include('modals.split-ticket')
</section>

<script type="text/javascript">
$('.divisionBtnWrap .division-btn,.splitTicket .btnSplit').click(function(){
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
@if (!is_null($userticket->expired_date) && $userticket->expired_date > date('Y-m-d H:i:s'))

var now = new Date(@millisecond($date_now));
var targetDate = new Date(@millisecond($userticket->expired_date));
var pageOpendt = new Date();
var difference = targetDate - now;
countDown();

function countDown() {
    var currentDate = new Date();
    var left = difference - (currentDate - pageOpendt);
    if(left < 1000){
        $("#TimeLeft").text("Expired");
        $(".msgArea").removeClass("hide");
        return;
    }
    var a_day = 24 * 60 * 60 * 1000;
    var d = Math.floor(left / a_day)
    var h = Math.floor((left % a_day) / (60 * 60 * 1000))
    var m = Math.floor((left % a_day) / (60 * 1000)) % 60
    var s = Math.floor((left % a_day) / 1000) % 60 % 60

    var timeLeftText;
    if(d == 0){
        timeLeftText = h + ':' + m + ':' + s;
    }else if(d <= 1){
        timeLeftText = d + 'day ' + h + ':' + m + ':' + s;
    }else{
        timeLeftText = d + 'days ' + h + ':' + m + ':' + s;
    }
    $("#TimeLeft").text(timeLeftText);
    setTimeout('countDown()', 1000);
}


@endif
</script>

@endsection
