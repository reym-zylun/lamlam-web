@extends('master')
@section('content')
<div id="nonSlide" class="clearfix">
    <ul>
        <li><img src="images/mv1.jpg" alt="Make you happy.さて！バスに乗ろう！" title=""></li>
    </ul>
</div>

<!--div id="slide">
    <ul>
        <li><img src="images/mv1.jpg" alt="Make you happy.さて！バスに乗ろう！" title=""></li>
        <li><img src="images/mv2_dummy.jpg" alt="" title=""></li>
        <li><img src="images/mv3_dummy.jpg" alt="" title=""></li>
    </ul>
</div-->

<section>
    <div id="tabTicket">
        <ul class="tab_select clearfix">
            <li class="current" id="tabRecommend"><span>Recommended</span> Pass</li>
            <li id="tabTime"><span>Time</span> Pass</li>
            <li id="tabDay"><span>Day</span> Pass</li>
        </ul>
    </div>
    <div class="tab_body bgTabTicket fw">
        <div class="tab_contents clearfix">
            <div id="ttlRecommend" class="ttlTabBox">Recommended Pass</div>
            <p class="ttlTabTxt">人気のパス一覧</p>
            <ul id="recList">
            @foreach($tickets['recommended'] as $ticket)
                <li {{{ $ticket->recommended ? 'data-text=No.1' : '' }}}>
                    <a href="{{ route('ticket-purchase',$ticket->id) }}">
                        <img src="{{ $ticket->image_url }}" alt="">
                        <dl class="ticketInfo">
                            <dt>{{ $ticket->name }}</dt>
                            <dd>
                            @if(is_null($ticket->adult_price))
                                {{ trans('custom.child') }}: ${{ $ticket->child_price }}
                            @elseif(is_null($ticket->child_price))
                                {{ trans('custom.adult') }}: ${{ $ticket->adult_price }}
                            @else
                                {{ trans('custom.adult') }}: ${{ $ticket->adult_price }} / {{ trans('custom.child') }}: ${{ $ticket->child_price }}
                            @endif
                            </dd>
                        </dl>
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
        
        <div class="tab_contents tab_hidden clearfix">
            <div id="ttlTime" class="ttlTabBox">Time Pass</div>
            <p class="ttlTabTxt">タイムパス一覧</p>
            <ul id="recList">
            @foreach($tickets['time'] as $ticket)
                <li {{{ $ticket->recommended ? 'data-text=No.1' : '' }}}>
                    <a href="{{ route('ticket-purchase',$ticket->id) }}">
                        <img src="{{ $ticket->image_url }}" alt="">
                        <dl class="ticketInfo">
                            <dt>{{ $ticket->name }}</dt>
                            <dd>
                            @if(is_null($ticket->adult_price))
                                {{ trans('custom.child') }}: ${{ $ticket->child_price }}
                            @elseif(is_null($ticket->child_price))
                                {{ trans('custom.adult') }}: ${{ $ticket->adult_price }}
                            @else
                                {{ trans('custom.adult') }}: ${{ $ticket->adult_price }} / {{ trans('custom.child') }}: ${{ $ticket->child_price }}
                            @endif
                            </dd>
                        </dl>
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="tab_contents tab_hidden clearfix">
            <div id="ttlDay" class="ttlTabBox">Day Pass</div>
            <p class="ttlTabTxt">デイパス一覧</p>
            <ul id="recList">
            @foreach($tickets['day'] as $ticket)
                <li {{{ $ticket->recommended ? 'data-text=No.1' : '' }}}>
                    <a href="{{ route('ticket-purchase',$ticket->id) }}">
                        <img src="{{ $ticket->image_url }}" alt="">
                        <dl class="ticketInfo">
                            <dt>{{ $ticket->name }}</dt>
                            <dd>
                            @if(is_null($ticket->adult_price))
                                {{ trans('custom.child') }}: ${{ $ticket->child_price }}
                            @elseif(is_null($ticket->child_price))
                                {{ trans('custom.adult') }}: ${{ $ticket->adult_price }}
                            @else
                                {{ trans('custom.adult') }}: ${{ $ticket->adult_price }} / {{ trans('custom.child') }}: ${{ $ticket->child_price }}
                            @endif
                            </dd>
                        </dl>
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
</section>

    
<div id="infoBann" class="fadeBox clearfix">
    <section>
        <div id="infoBox">
            <h3>Information</h3>
            <p class="ttlTabTxt">お知らせ</p>
            <div class="infoList">
                <dl>
                @foreach($infos as $info)
                    <dt>{{ date('Y.m.d', strtotime($info->open_date)) }}</dt>
                    <dd>{!! nl2br($info->comments) !!}</dd>
                @endforeach
                </dl>
            </div>
        </div>
    </section>

    <section class="fadeBox">
        <div id="bannBox" class="fw">
            <h3>Campaign</h3>
            <p class="ttlTabTxt2">キャンペーン</p>
            <ul>
                <a href="" target="_blank"><li><img src="images/bann1.png" alt="お試しタイムパス 1時間無料進呈"><span class="txtBann1">アプリをダウンロード<br>した方限定！<br>『お試し1時間パス』を<br>プレゼントいたします。</span></li></a>
            </ul>
        </div>
    </section>
</div>

<section class="fadeBox">
    <div id="movieBox">
        <h4>Movie</h4>
        <p class="ttlTabTxt">動画</p>
        <div class="thumbMovie">
            <div class="video_image">
                <p class="btnMoviePlay"><a class="popup-youtube" href="http://www.youtube.com/watch?v=z-YKoOA1z04" title="Lam Lam Rap 2013　ラムラムツアーズ・ラムラムラップ2013">Lam Lam Rap 2013　ラムラムツアーズ・ラムラムラップ2013</a></p>
            </div>
        </div>
    </div>        
</section>
@endsection
@section('script')
<!-- Modal Vertical Alignment -->
<script type="text/javascript">
$(document).ready(function(){
    
    //スライダー
    var obj = $('#slide ul').bxSlider({
        auto: true, //スライドショー自動再生
        pause: 6000, //停止時間
        speed: 1000, //スライドスピード
        mode: 'horizontal', //スライドモード
        controls: true, //コントロール（Next, Prev）表示
        pager: false,
        captions:false,
        //onSlideAfter:function(){ obj.startAuto();} //コントロール類をクリックした場合にスライド終了を、自動再開
    });
    
    $(".tab_select li").click(function() {
        var num = $(".tab_select li").index(this);
        $(".tab_contents").addClass('tab_hidden');
        $(".tab_contents").eq(num).removeClass('tab_hidden');
        $(".tab_select li").removeClass('current');
        $(this).addClass('current');
    });
    
    $('.popup-youtube').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
    
});
</script>
@endsection
