@extends('master')
@section('content')

<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.ticket-receive') }}</li>
</ul><!-- End of .breadCrumb-->

<!-- Manual Ticket  -->
<section id="manualTicketAdd" class="wrapper clearfix">
    <div class="mainWrap">

        <div class="pure-g">
            <div class="pure-u-1">

                <div class="ticketProd">
                    <div class="pageTitle">{{ trans('custom.title.ticket-receive-complete') }}</div>
                </div>

                <div class="pure-u-1 form-row completionMsg">
                    {{ trans('custom.receive-complete') }}
                </div>

                <div class="btnWrap">
                    <a href="/users/{{ $user_id }}/tickets/receive"><button type="button" class="confirm-btn">{{ trans('custom.receive-again') }}</button></a>
                </div>
        
            </div>
        </div>

    </div>
</section>
<!-- End of #manualTickedAdd -->

@endsection
