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
                    <div class="pageTitle">{{ trans('custom.title.contact') }}</div>
                </div><!-- End of .ticketProd -->

                <form method="post" action="/contact" class="commonForm">
                    @include('error-message')
                    {{-- CSRF対策--}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pure-u-1 form-row">
                        <label for="name">{{ trans('custom.name') }}:</label><input type="text" name="name" value="{{ $con->name or '' }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="email">{{ trans('custom.email') }}:</label><input type="email" name="email" value="{{ $con->email or '' }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="message">{{ trans('custom.message') }}:</label>
                        <textarea name="message" rows="10" cols="30">{{ $con->message or '' }}</textarea>
                    </div>
                    <div class="btnWrap">
                        <button type="submit" class="confirm-btn" name="_registtype" value="Validate">{{ trans('custom.confirm') }}</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</section>
<!-- End of #contactForm -->

@endsection
