@extends('master')
@section('content')

<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.my-ticket-cancel-select') }}</li>
</ul><!-- End of .breadCrumb-->

<section id="myTicket">
    <div class="mainWrap">
        <div class="pageTitle">{{ trans('custom.title.my-ticket-cancel-select') }}</div>
        {{ trans('custom.cancel-ticket-info') }}
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
                                Purchased On: <strong>@datetime($v->purchase_date)</strong>
                        </div>
                        <div class="myTicketButtons">
                            <button class="detailTicket-btn" onclick="window.location='{{route('user.tickets.cancel',[session()->get('user')->id,$v->id])}}'">{{ trans('custom.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
<!-- End of #myTicket -->
@endsection
