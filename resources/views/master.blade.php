<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ラムラムツアーズ　赤いシャトルバス</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-itunes-app" content="app-id={{config('define.store_id.ios')}}"/>

@if(\Request::route()->getName() == "top")
<!-- Start SmartBanner configuration -->
<meta name="smartbanner:title" content="{{ trans('custom.store-name')}}">
<meta name="smartbanner:author" content="{{config('define.site_company')}}">
<meta name="smartbanner:price" content="{{ trans('custom.smartapp-price-text')}}">
<meta name="smartbanner:price-suffix-google" content=" - In Google Play">
<meta name="smartbanner:icon-google" content="{{ url('images/lamlam_bus.png') }}">
<meta name="smartbanner:button" content="{{ trans('custom.smartapp-button-text')}}">
<meta name="smartbanner:button-url-google" content="/openapp">
<meta name="smartbanner:enabled-platforms" content="android">
<!-- End SmartBanner configuration -->
@endif

<!--meta property="fb:app_id" content="">
<meta property="og:type" content="website">
<meta property="og:url" content="ページURL">
<meta property="og:title" content="ページ名">
<meta property="og:image" content="デフォルト画像">
<meta property="og:description" content="description"-->

@if(\Request::route()->getName() == "user.tickets" ||
    \Request::route()->getName() == "user.tickets.show" ||
    \Request::route()->getName() == "ticket-list" ||
    \Request::route()->getName() == "user.tickets.cancel-select" ||
    \Request::route()->getName() == "user.tickets.cancel")

<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css" media="all">
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal.min.css" media="all">
<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/slicknav.css') }}" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/reset.css') }}" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/common.css') }}" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/style.css?v=3') }}" media="all">

<!--[if lt IE 9]>
<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

@else

<link type="text/css" rel="stylesheet" href="{{ url('css/slicknav.css') }}" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/jquery.bxslider.css') }}" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/magnific-popup.css') }}" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/reset.css') }}" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/common.css') }}" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/style.css?v=3') }}" media="all">
<link type="text/css" rel="stylesheet" href="{{ url('css/pure-min.css') }}" media="all">
<!--[if lte IE 8]>
<link rel="stylesheet" href="http://yui.yahooapis.com/combo?pure/0.6.0/base-min.css&pure/0.6.0/grids-min.css&pure/0.6.0/grids-responsive-old-ie-min.css">
<![endif]-->
<!--[if gt IE 8]><!-->
<link type="text/css" rel="stylesheet" href="{{ url('css/pure-combo-min.css') }}" media="all">
<!--<![endif]-->

<!--[if lt IE 9]>
<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
@endif

@if(\Request::route()->getName() == "top")
<link type="text/css" rel="stylesheet" href="{{ url('css/smart-app-banner.css') }}">
@endif

<script src="{{ url('js/jquery-2.0.3.min.js') }}"></script>

@yield('js')
@yield('css')

</head>
<body>

@if(\Request::route()->getName() != "login" &&
    \Request::input('pf_t') != "app") 
    @include('menu')
@endif
@yield('content')

@if(\Request::input('pf_t') != "app") 
<footer>
<div id="footerBox">
    <div class="wrapper clearfix">
        <div class="logoCopyBox">
            <a class="logoFooter" href="/"><h4>LAMLAM TOURS & TRANSPORTATION</h4></a>
            <p>{!!config("define.copy_right")!!}  Copyright (C) LAMLAM TOURS & TRANSPORTATION All Rights Reserved.</p>
        </div>
        <a class="topArw" href="#headerInner">
            &#xFFEA;
        </a>
    </div>
</div>
</footer><!--/footer-->
@endif

@if(\Request::route()->getName() == "user.tickets" ||
    \Request::route()->getName() == "user.tickets.show" ||
    \Request::route()->getName() == "ticket-list")
<script type="text/javascript" src="{{ url('js/jquery.slicknav.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.inview.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modal.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.js"></script>
@else
<script type="text/javascript" src="{{ url('js/jquery.bxslider.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.slicknav.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.inview.min.js') }}"></script>
@endif
@if(\Request::route()->getName() == "top")
<script type="text/javascript" src="{{ url('js/smart-app-banner.js') }}"></script>
@endif

<script>
$(document).ready(function(){

    $('a[href^=#]').click(function(){
        var speed = 500;
        var href= $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top;
        $("html, body").animate({scrollTop:position}, speed, "swing");
        return false;
    });

    $('#gnavInner').slicknav({
        label: '',
        prependTo:'#gnav',
    });

});
//fadeBox
$(function(){
    var setElm = $('.fadeBox'),
    delayHeight = 100;

    setElm.css({display:'block',opacity:'0'});
    $('html,body').animate({scrollTop:0},1);

    $(window).on('load scroll resize',function(){
        setElm.each(function(){
            var setThis = $(this),
            elmTop = setThis.offset().top,
            elmHeight = setThis.height(),
            scrTop = $(window).scrollTop(),
            winHeight = $(window).height();
            if (scrTop > elmTop - winHeight + delayHeight && scrTop < elmTop + elmHeight){
                setThis.stop().animate({opacity:'1'},200);            }
        });
    });
});
</script>
@yield('script')

</body>
</html>
