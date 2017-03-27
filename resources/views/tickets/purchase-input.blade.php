@extends('master')
@section('content')

<ul class="wrapper breadCrumb">
    <li><a href="/">{{ trans('custom.title.top') }}</a></li>
    <li><a href="/tickets">{{ trans('custom.title.ticket') }}</a></li>
    <li>{{ trans('custom.title.ticket-purchase') }}</li>
</ul><!-- End of .breadCrumb-->

<!-- Ticket Detail -->
<section id="ticketDetail" class="wrapper clearfix">
    <div class="mainWrap">

        <div id="ticketProdWrap">
            <div class="pure-g">

                <div class="ticketProd pure-u-1 pure-u-md-2-3">
                    <div class="pageTitle">{{ trans('custom.title.ticket-purchase') }}</div>
                    <h1>{{ $ticket->name }}</h1>
                    <div class="tixImgDetail">
                        <img src="{{ $ticket->image_url }}" alt="{{ $ticket->name }}" width="308" height="224" />
                    </div>
                    <div id="ticketInfo">
                        <ul class="ticketInfoList">
                            <li>{{ $ticket->description }}</li>
                        </ul>
                    </div>
                </div><!-- End of .ticketProd -->

                <div class="ticketPassengers pure-u-1 pure-u-md-1-3">
                    <form method="post" action="/tickets/{{ $ticket->id }}" class="commonForm">
                        @include('error-message')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if(!is_null($ticket->adult_price))
                        <div class="pure-u-1 form-row cullum3">
                            <label for="adult">{{ trans('custom.adult') }}</label>
                            <select id="adult" class="formItem" name="adult_num">
                            @for ($i = 0; $i < 10; $i++)
                                @if (isset($input->adult_num) && $input->adult_num == $i)
                                    <option selected>{{$i}}</option>
                                @else
                                    <option>{{$i}}</option>
                                @endif
                            @endfor
                            </select>
                            <span id="adultPrice" class="tixPrice">${{ number_format($ticket->adult_price, 2) }}</span>
                        </div>
                        @endif
                        @if(!is_null($ticket->child_price))
                        <div class="pure-u-1 form-row cullum3">
                            <label for="children">{{ trans('custom.child') }}</label>
                            <select id="children" class="formItem" name="child_num">
                            @for($i = 0; $i < 10; $i++)
                                @if (isset($input->child_num) && $input->child_num == $i)
                                    <option selected>{{$i}}</option>
                                @else
                                    <option>{{$i}}</option>
                                @endif
                            @endfor
                            </select>
                            <span id="childPrice" class="tixPrice">${{ number_format($ticket->child_price, 2) }}</span>
                        </div>
                        @endif
                        <div class="pure-u-1 form-row">
                            <div class="tixTotal">{{ trans('custom.total') }}: ${{ number_format($input->total_price, 2) }}</div>
                        </div>
                        <div class="btnWrap">
                            <button type="submit" class="confirm-btn" name="_type" value="Validate">{{ trans('custom.confirm') }}</button>
                        </div>
                    </form>
                </div><!-- End of .ticketPassengers -->

            </div>
        </div><!-- End of #ticketProdWrap -->

    </div>
</section>
<!-- End of #ticketDetail -->
@endsection
@section('script')
<script type="text/javascript">                     
Number.prototype.formatMoney = function(c, d, t){
  var n = this, 
      c = isNaN(c = Math.abs(c)) ? 2 : c, 
      d = d == undefined ? "." : d, 
      t = t == undefined ? "," : t, 
      s = n < 0 ? "-" : "", 
      i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
      j = (j = i.length) > 3 ? j % 3 : 0;
  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
$(function(){                                       
  $( "#adult,#children" ).change(function(e) {
    var adultPrice = Number($("#adultPrice").text().substr(1));
    var adultCount = Number($("#adult").val() == undefined?0:$("#adult").val());
    var childPrice = Number($("#childPrice").text().substr(1));
    var childCount = Number($("#children").val() == undefined?0:$("#children").val());
    var totalPrice = adultPrice * adultCount + childPrice * childCount;
    $(".tixTotal").text("Total: $" + totalPrice.formatMoney(2));
  });                                         
});                                                 
</script>
@endsection
