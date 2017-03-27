@extends('master')
@section('content')

<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li>{{ trans('custom.title.ticket') }}</li>
</ul><!-- End of .breadCrumb-->
<section id="ticketList clearfix">
    <div class="mainWrap">
    <div class="pageTitle">{{ trans('custom.title.ticket') }}</div>
        <h2>Time Pass</h2>
        <div class="ticketListWrap">
        @foreach($tickets->time as $item)
            <div class="ticketListCard">
                <div class="ticketListInfoWrap">
                    <div class="ticketListName">{{ $item->name}}</div>
                    <img class="spOnly" src="{{ $item->image_url}}" alt="{{ $item->name }}"/>
                    <img src="{{ $item->image_url}}" alt="{{ $item->name }}"/>
                    <div class="ticketListPrice">
                        @if(!is_null($item->adult_price))
                            {{ ucfirst(trans('custom.adult')) }}: <strong>${{ $item->adult_price }}</strong><br />
                        @endif
                        @if(!is_null($item->child_price))
                             {{ ucfirst(trans('custom.child')) }}: <strong>${{ $item->child_price }}</strong>
                        @endif
                    </div>
                    <div class="ticketListDetails">{{ $item->description }}</div>
                    <a class="btnDefault moreInfo-btn" href="/tickets/{{ $item->id }}">More Info</a>
                </div>
            </div>
        @endforeach
        </div>
        <h2>Day Pass</h2>
        <div class="ticketListWrap">
        @foreach($tickets->day as $item)
            <div class="ticketListCard">
                <div class="ticketListInfoWrap">
                    <div class="ticketListName">{{ $item->name}}</div>
                    <img class="spOnly" src="{{ $item->image_url}}" alt="{{ $item->name }}"/>
                    <img src="{{ $item->image_url}}" alt="{{ $item->name }}"/>
                    <div class="ticketListPrice">
                        @if(!is_null($item->adult_price))
                            {{ ucfirst(trans('custom.adult')) }}: <strong>${{ $item->adult_price }}</strong><br />
                        @endif
                        @if(!is_null($item->child_price))
                            {{ ucfirst(trans('custom.child')) }}: <strong>${{ $item->child_price }}</strong>
                        @endif
                    </div>
                    <div class="ticketListDetails">{{ $item->description }}</div>
                    <a class="btnDefault moreInfo-btn" href="/tickets/{{ $item->id }}">More Info</a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>
<!-- End of #ticketList -->
@endsection
