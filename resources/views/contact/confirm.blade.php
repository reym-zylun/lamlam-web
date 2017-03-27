@extends('master')
@section('content')


<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.contact') }}</li>
</ul><!-- End of .breadCrumb-->

<!-- contact form -->
<section id="contactForm" class="wrapper clearfix">
    <div class="mainWrap">

        <div class="pure-g">
            <div class="pure-u-1">

                <div class="ticketProd">
                    <div class="pageTitle">{{ trans('custom.title.contact-confirm') }}</div>
                </div><!-- End of .ticketProd -->

                <form method="post" action="/contact" class="commonForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pure-u-1 form-row">
                        <label for="name">{{ trans('custom.name') }}:</label><span class="formItem">{{ $con->name }}</span><input type="hidden" name="name" value="{{ $con->name }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="email">{{ trans('custom.email') }}:</label><span class="formItem">{{ $con->email }}<input type="hidden" name="email" value="{{ $con->email }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <span class="formItem">{!! nl2br(htmlspecialchars($con->message ,ENT_QUOTES)) !!}</span><input type="hidden" name="message" value="{{ $con->message }}">
                    </div>
                    <div class="btnWrap">
                        <button type="submit" class="back-btn" name="_registtype" value="back">{{ trans('custom.back') }}</button>
                        <button type="submit" class="confirm-btn" name="_registtype" value="Regist">{{ trans('custom.complete') }}</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</section>
<!-- End of #contactForm -->
@endsection
