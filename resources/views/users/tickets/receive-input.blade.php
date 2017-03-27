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
                    <div class="pageTitle">{{ trans('custom.title.ticket-receive') }}</div>
                </div>

                <form method="post" action="{{ route('receive-post', $user_id) }}" class="commonForm">
                    <span class="manualTicketNote">{{ trans('custom.receive-caution') }}</span>
                    @include('error-message')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pure-u-1 form-row">
                        <label for="ticketNo">{{ trans('custom.ticket-no') }}:</label><input type="text" name="receive_key" value="{{ $input->receive_key or ''}}">
                    </div>

                    <div class="btnWrap">
                        <button type="submit" class="confirm-btn" name="_registtype" value="validate">{{ trans('custom.confirm')}}</button>
                    </div>

                </form>             
            </div>
        </div>

    </div>
</section>
<!-- End of #manualTickedAdd -->
@endsection
