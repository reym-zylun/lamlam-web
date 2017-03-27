@extends('master')
@section('content')

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
                <div class="pageTitle">{{ trans('custom.title.payment-complete') }}</div>

                <div class="pure-u-1 form-row completionMsg">
                    {{ trans('custom.payment-complete') }}
                    @if (\Request::input('pf_t') != "app" && session()->has("user"))
                    <p><a class="btnDefault" href="{{route('user.tickets',session()->get('user')->id)}}">{{ trans('custom.title.my-ticket') }}</a></p>
                    @elseif (\Request::input('pf_t') == "app")
                    <p><a class="btnDefault" href="http://go-to-myticket">{{ trans('custom.title.my-ticket') }}</a></p>
                    @endif
                </div>

            </div>
        </div>

    </div>
</section>
<!-- End of #paymentForm -->
@endsection
