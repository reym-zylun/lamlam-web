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
                    <div class="pageTitle">{{ trans('custom.title.password-complete') }}</div>
                </div><!-- End of .ticketProd -->

                <div class="pure-u-1 form-row completionMsg">
                    {{ trans('custom.password-reissue-complete') }}
                </div>

            </div>
        </div>

    </div>
</section>
<!-- End of #pwIssue -->
@endsection
