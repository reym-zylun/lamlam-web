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
                    <div class="pageTitle">{{ trans('custom.title.contact-complete') }}</div>
                </div><!-- End of .ticketProd -->

                <div class="pure-u-1 form-row completionMsg">
                    {{ trans('custom.contact-complete') }}
                </div>

            </div>
        </div>

    </div>
</section>
<!-- End of #contactForm -->
@endsection
