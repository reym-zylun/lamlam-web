<header>
    <div class="wrapper" id="headerInner">
        <div id="gnav" class="clearfix">
            <nav>
                <ul id="gnavInner">
                    <li>{{ trans('custom.lamlambus') }}
                        <ul>
                            <li><a href="{{route('ticket-list')}}">{{ trans('custom.title.ticket-purchase') }}</a></li>
                            <li><a href="{{url('images/route.jpg')}}">{{ trans('custom.title.route') }}</a></li>
                            <li><a href="{{url('images/timetable.jpg')}}">{{ trans('custom.title.timetable') }}</a></li>
                        </ul>
                    </li>
                    <li>{{ trans('custom.mypage') }}
                        <ul>
                        @if(session()->has('access_token'))
                            <li><a href="{{route('user.tickets',session()->get('user')->id)}}">{{ trans('custom.title.my-ticket') }}</a></li>
                            <li><a href="{{route('user.editmethod',session()->get('user')->id)}}">{{ trans('custom.title.user-edit') }}</a></li>
                            <li><a href="{{route('user.tickets.cancel-select',session()->get('user')->id)}}">{{ trans('custom.title.my-ticket-cancel') }}</a></li>
                            <li><a href="{{route('logout')}}">{{ trans('custom.title.logout') }}</a></li>
                        @else
                            <li><a href="{{route('login')}}">{{ trans('custom.title.login') }}</a></li>
                            <li><a href="{{route('user.regmethod')}}">{{ trans('custom.title.user-reg') }}</a></li>
                        @endif
                        </ul>
                    </li>
                    <li>{{ trans('custom.about-site') }}
                        <ul>
                            <li><a href="/privacy-policy">{{ trans('custom.title.privacy-policy') }}</a></li>
                            <li><a href="/contact">{{ trans('custom.title.contact') }}</a></li>
                        </ul>
                    </li>   
                </ul>
            </nav>
        </div>
            
        <div id="logoBox">
            <a href="/"><h1>LAMLAM TOURS & TRANSPORTATION</h1></a>
        </div>
        
        <div id="utilityBox">
            <ul>
                <li><a href="{{url('images/route.jpg')}}" target="_blank">{{ trans('custom.title.route') }}</a></li>
                <li><a href="{{url('images/timetable.jpg')}}" target="_blank">{{ trans('custom.title.timetable') }}</a></li>
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <li><a href="{{ route('lang.switch', $lang) }}">{{$language}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</header><!--/header-->
