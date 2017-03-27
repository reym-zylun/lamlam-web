@extends('master')
 
@section('content')
<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.user-edit') }}</li>
</ul><!-- End of .breadCrumb-->

<!-- registration -->
<section id="registration" class="wrapper clearfix">
    <div class="mainWrap">

        <div class="pure-g">
            <div class="pure-u-1">

                <div class="ticketProd">
                    <div class="pageTitle">{{ trans('custom.title.user-edit-confirm') }}</div>
                </div><!-- End of .ticketProd -->

                <form method="post" action="/users/{{$id}}/edit" class="commonForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pure-u-1 form-row">
                        <label for="name">{{ trans('custom.name') }}:</label>{{ $usr->name }}
                        <input type="hidden" name="name" value="{{ $usr->name }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="email">{{ trans('custom.email') }}:</label>{{ $usr->email }}
                        <input type="hidden" name="email" value="{{ $usr->email }}">
                        <input type="hidden" name="email_confirm" value="{{ $usr->email_confirm }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="password">{{ trans('custom.password') }}:</label>**********
                        <input type="hidden" name="password" value="{{ $usr->password }}">
                        <input type="hidden" name="password_confirm" value="{{ $usr->password_confirm }}">
                    </div>
                    <div class="pure-u-1 form-row">
                        <label for="subscribe">{{ trans('custom.email-magazine-subscribed') }} :</label><input type="checkbox" disabled="disabled" {{ !empty($usr->email_magazine_subscribed) ? 'checked="checked"' : '' }}>
                        <input type="hidden" name="email_magazine_subscribed" value="{{ $usr->email_magazine_subscribed }}">
                    </div>
                    <div class="btnWrap">
                        <button type="submit" class="back-btn" name="_edittype" value="Back" >{{ trans('custom.back') }}</button>
                        <button type="submit" class="confirm-btn" name="_edittype" value="Save">{{ trans('custom.complete') }}</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</section>
<!-- End of #registration -->

@endsection
