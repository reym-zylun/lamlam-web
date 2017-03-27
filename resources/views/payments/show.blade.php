@extends('master')
@section('content')
<script>
    $(document).ready(function(){
        $("#payment-btn").click(function(){
            $("#payment-btn").hide();
            $("#pleasewait").show();
        });
    });
</script>

@if(\Request::input('pf_t') != "app") 
<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.payment') }}</li>
</ul><!-- End of .breadCrumb-->
@endif

<!-- payment form -->
<section id="paymentForm" class="wrapper clearfix">
    <div class="mainWrap">

        <div class="pure-g">
            <div class="pure-u-1">
                <div class="pageTitle">{{ trans('custom.title.payment') }}</div>

                <form action="" class="commonForm">    
                    @include('error-message')
                    <div class="paymentTitle">{{ trans('custom.ticket-information') }}</div>
                    <div class="pure-u-1 form-row">
                        <label for="ticket_name">{{ trans('custom.ticket-name') }} :</label><span class="formItem">{{ $payment->name }}</span>
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="adult_no">{{ trans('custom.adult') }} :</label><span class="formItem">{{ $payment->adult_num }}</span>
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="child_no">{{ trans('custom.child') }} :</label><span class="formItem">{{ $payment->child_num }}</span>
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="total_amt">{{ trans('custom.total-amount') }}:</label><span class="formItem">${{ $payment->amount }}</span>
                    </div>
                </form>

                <form method="post" action="{{ getenv('APP_URL') }}/payments/{{ $payment->token }}?pf_t={{ \Request::input('pf_t') }}" class="commonForm" autocomplete="off">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="inputToken"/>
                    <div class="paymentTitle">{{ trans('custom.card-information') }}</div>
                    <div class="pure-u-1 form-row">
                        <label for="card_no">{{ trans('custom.card-no') }} :</label><input type="text" name="cardNumber" value="{{ old('cardNumber') }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="card_security">{{ trans('custom.card-security-code') }} :</label><input class="width100" type="text" name="cardCode" value="{{ old('cardCode') }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="card_expiry">{{ trans('custom.card-expired-date') }} :<br />(MM/YY)</label><input class="width100" type="text" name="cardExpirationDate" value="{{ old('cardExpirationDate') }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="card_name">{{ trans('custom.card-name') }} :</label><input type="text" name="cardName" value="{{ old('cardName') }}">
                    </div>
                    <div class="btnWrap">
                        <button id="payment-btn" type="submit" class="confirm-btn">{{ trans('custom.payment') }}</button>
                    </div>
                    <div>
                        <p id="pleasewait" style="display:none;height:44px;text-align:center;"><img src="{{URL::asset('images/loading.gif')}}" height="18" />Please wait . . .</p>
                    </div>
                <div>
                </form>

            </div>
        </div>

    </div>
</section>
<!-- End of #paymentForm -->
@endsection
