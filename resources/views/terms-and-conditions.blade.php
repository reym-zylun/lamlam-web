@extends('master')
@section('content')

@if(\Request::input('pf_t') != "app") 
<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.terms-and-conditions') }}</li>
</ul><!-- End of .breadCrumb-->
@endif

<!-- Privacy Policy  -->
<section id="privacyPolicy" class="wrapper clearfix">
    <div class="mainWrap">

        <div class="pure-g">
            <div class="pure-u-1">

                <div class="ticketProd">
                    <div class="pageTitle">{{ trans('custom.title.terms-and-conditions') }}</div>
                </div>
                <div class="pure-u-1 form-row pageContent">
                    {!! trans('terms-and-conditions') !!} 
                </div>
            </div>
        </div>

    </div>
</section>
<!-- End of #privacyPolicy -->

@endsection
