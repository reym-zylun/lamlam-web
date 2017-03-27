@extends('master')
@section('content')
<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.password') }}</li>
</ul><!-- End of .breadCrumb-->

<!-- password issue -->
<section id="pwIssue" class="wrapper clearfix">
    <div class="mainWrap">

        <div class="pure-g">
            <div class="pure-u-1">

                <div class="ticketProd">
                    <div class="pageTitle">{{trans('custom.title.password')}}</div>
                </div><!-- End of .ticketProd -->

                <form method="POST" action="/password" class="commonForm">
                    @include('error-message')
                    {{-- CSRF対策--}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pure-u-1 form-row">
                        <div class="msg">{{ trans('custom.password-reissue') }}</div>
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="email">{{ trans('custom.email') }}:</label><input type="email" name="email" value="{{ $input->email or ''}}">
                    </div>
                    <div class="btnWrap">
                        <button type="submit" class="confirm-btn">{{ trans('custom.reissue') }}</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</section>
<!-- End of #pwIssue -->

@endsection
