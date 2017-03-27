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
                    <div class="pageTitle">{{ trans('custom.title.user-reg-complete') }}</div>
                </div><!-- End of .ticketProd -->

                <div class="pure-u-1 form-row completionMsg">
                    {!! trans('custom.user-reg-completed') !!}
                </div>
                    
            </div>
        </div>

    </div>
</section>
<!-- End of #registration -->

@endsection
