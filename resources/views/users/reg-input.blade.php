@extends('master')
@section('content')

<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.user-reg') }}</li>
</ul><!-- End of .breadCrumb-->

<!-- registration -->
<section id="registration" class="wrapper clearfix">
    <div class="mainWrap">

        <div class="pure-g">
            <div class="pure-u-1">

                <div class="ticketProd">
                    <div class="pageTitle">{{ trans('custom.title.user-reg') }}</div>
                </div><!-- End of .ticketProd -->

                <form method="post" action="/users/regist" class="commonForm">
                    @include('error-message')
                    {{-- CSRF対策--}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pure-u-1 form-row">
                        <label for="name">{{ trans('custom.name') }} :</label><input type="text" name="name" value="{{ $usr->name or '' }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="email">{!! trans('custom.email') !!} :</label><input type="email" name="email" value="{{ $usr->email or '' }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="email_confirm">{!! trans('custom.confirm-email') !!} :</label><input type="email" name="email_confirm" value="">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="subscribe">{{ trans('custom.email-magazine-subscribed') }} :</label><input type="checkbox" id="subscribe" name="email_magazine_subscribed" value="1" {{ !empty($usr->email_magazine_subscribed) ? 'checked' : ''}}>
                    </div>
                    <div class="pure-u-1 form-row">
                        <div class="messageScroll">{!! trans('terms-and-conditions') !!}</div>
                    </div>
                    <div class="pure-u-1 form-row">
                        <label style="width:auto;margin-right:10px;" for="service_term">{{trans('custom.terms-and-conditions-agree')}}</label><input type="checkbox" id="service_term" name="service_term" value="1" {{ !empty($usr->service_term) ? 'checked' : ''}}>
                    </div>
                    <div class="pure-u-1 form-row">
                        <span style="color:red;">
                            {!! trans('custom.hotmail-emergency', ['email' => env('MAIL_ADDRESS')]) !!}
                        </span>
                    </div>
                    <div class="btnWrap">
                        <button type="submit" class="confirm-btn" name="_regtype" value="Validate">{{ trans('custom.confirm') }}</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</section>
<!-- End of #registration -->

@endsection
