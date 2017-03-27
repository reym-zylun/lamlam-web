@extends('master')
@section('content')

<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li><a href="/tickets">{{ trans('custom.title.ticket') }}</a></li>
    <li>{{ trans('custom.title.ticket-purchase') }}</li>
</ul><!-- End of .breadCrumb-->

<!-- Ticket Detail -->
<section id="ticketDetail" class="wrapper clearfix">
    <div class="mainWrap">

        <div id="ticketProdWrap">
            <div class="pure-g">

                <div class="ticketProd pure-u-1 pure-u-md-2-3">
                    <div class="pageTitle">{{ trans('custom.title.ticket-purchase-confirm') }}</div>
                    <h1>{{ $ticket->name }}</h1>
                    <div class="tixImgDetail">
                        <img src="{{ $ticket->image_url }}" alt="{{ $ticket->name }}" width="308" height="224" />
                    </div>
                    <div id="ticketInfo">
                        <ul class="ticketInfoList">
                            <li>{{ $ticket->description }}</li>
                        </ul>
                    </div>
                </div><!-- End of .ticketProd -->

                <div class="ticketPassengers pure-u-1 pure-u-md-1-3">
                    <form method="post" action="/tickets/{{ $ticket->id }}" class="commonForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if(!is_null($ticket->adult_price))
                        <div class="pure-u-1 form-row cullum3">
                            <label for="adult">{{ trans('custom.adult') }}</label>
                            <span class="formItem">{{ $input->adult_num }}</span>
                            <span class="tixPrice">${{ number_format($ticket->adult_price, 2) }}</span>
                            <input type="hidden" name="adult_num" value="{{ $input->adult_num }}">
                        </div>
                        @endif
                        @if(!is_null($ticket->child_price))
                        <div class="pure-u-1 form-row cullum3">
                            <label for="children">{{ trans('custom.child') }}</label>
                            <span class="formItem">{{ $input->child_num }}</span>
                            <span class="tixPrice">${{ number_format($ticket->child_price, 2) }}</span>
                            <input type="hidden" name="child_num" value="{{ $input->child_num }}">
                        </div>
                        @endif
                        <div class="pure-u-1 form-row">
                            <div class="tixTotal">{{ trans('custom.total') }}: ${{ number_format($input->total_price, 2) }}</div>
                        </div>
                        <div class="btnWrap">
                            <button type="submit" class="back-btn" name="_type" value="Back">{{ trans('custom.back') }}</button>
                            <button type="submit" class="confirm-btn" name="_type" value="Buy">{{trans('custom.purchase') }}</button>
                        </div>
                    </form>
                </div><!-- End of .ticketPassengers -->

            </div>
        </div><!-- End of #ticketProdWrap -->

    </div>
</section>
<!-- End of #ticketDetail -->
@endsection
