@extends('master')
@section('content')

<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li><a href="/users/{{ $user_id }}/tickets/cancel">{{ trans('custom.title.my-ticket-cancel-select') }}</a></li>
    <li>{{ trans('custom.title.my-ticket-cancel') }}</li>
</ul><!-- End of .breadCrumb-->

<!-- contact form -->
<section id="contactForm" class="wrapper clearfix">
    <div class="mainWrap">
        <div class="pageTitle">{{ trans('custom.title.my-ticket-cancel') }}</div>
        <div class="myTicketWrap hover{{ ucfirst($userticket->color) }}">
            <div class="myTicketBox">
                <div class="myTicketThumbnail">
                    <div class="myTicketTitle">{{ $userticket->name }}</div>
                    <img class="spOnly" src="{{ $userticket->image_url}}" alt="{{ $userticket->name }}" width="70">
                    <img src="{{ $userticket->image_url }}" alt="{{ $userticket->name }}"/>
                </div>

                <div class="myTicketInfoWrap">
                    <div class="paxBox">
                        <h3 class="numPax">{{ $userticket->child_num + $userticket->adult_num }}<small>PAX</small></h3>
                    </div>
                    <div class="myTicketPassengers">
                        <span>{{ trans('custom.adult') }}: <strong id="adult{{ $userticket->id }}">{{ $userticket->adult_num }}{{ trans_choice('custom.sheet', $userticket->adult_num) }}</strong></span>
                        <span>{{ trans('custom.child') }}: <strong id="child{{ $userticket->id }}">{{ $userticket->child_num }}{{ trans_choice('custom.sheet', $userticket->child_num) }}</strong></span>
                    </div>
                    <div class="myTicketStatus">
                        Purchased On: <strong>@datetime($userticket->purchase_date)</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="pure-g">
            <div class="pure-u-1">
                <form method="post" action="{{route('user.tickets.cancel',[session()->get('user')->id,$userticket->id])}}" class="commonForm">
                    @include('error-message')
                    {{-- CSRF対策--}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pure-u-1 form-row">
                        <label for="reason">{{ trans('custom.cancel-reason') }}:</label>
                        <textarea name="reason" rows="10" cols="30">{{ $con->reason or '' }}</textarea>
                    </div>
                    <div class="btnWrap">
                        <button type="submit" class="confirm-btn" name="_contype" value="Validate">{{ trans('custom.confirm') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End of #contactForm -->

@endsection

