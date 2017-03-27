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
                    <div class="pageTitle">{{ trans('custom.title.ticket-receive-confirm') }}</div>
                </div>

                <form method="post" action="{{ route('receive-post', $user_id) }}" class="commonForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h1>{{ $receive_ticket->name }}</h1>
                    <div class="tixImgDetail">
                        <img src="{{ $receive_ticket->image_url }}" alt="{{ $receive_ticket->name }}" width="308" height="224" />
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="ticketNo">{{ trans('custom.ticket-no') }}:</label><span class="formItem">{{ $receive_ticket->receive_key }}</span>
                        <input type="hidden" name="receive_key" value="{{ $receive_ticket->receive_key }}">
                    </div>

                    <div class="pure-u-1 form-row">
                        <label for="ticketDate">{{ trans('custom.purchase_date') }}:</label><span class="formItem">{{ $receive_ticket->purchase_date }}</span>
                    </div>

                    <div class="pure-u-1 form-row">
                        <label for="ticketDate">{{ ucfirst(trans('custom.adult')) }}:</label><span class="formItem">{{ $receive_ticket->adult_num }}</span>
                    </div>

                    <div class="pure-u-1 form-row">
                        <label for="ticketDate">{{ ucfirst(trans('custom.child')) }}:</label><span class="formItem">{{ $receive_ticket->child_num }}</span>
                    </div>

                    <div class="btnWrap">
                        <button type="submit" class="back-btn" name="_registtype" value="back">{{ trans('custom.back')}}</button>
                        <button type="submit" class="confirm-btn" name="_registtype" value="regist">{{ trans('custom.receive') }}</button>
                    </div>

                </form>             
            </div>
        </div>

    </div>
</section>
<!-- End of #manualTickedAdd -->
@endsection
