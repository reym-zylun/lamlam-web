@section('js')
<script type="text/javascript">
$(document).ready(function() {
function timer(){var e=Math.floor(seconds/24/60/60),t=Math.floor(seconds-86400*e),o=Math.floor(t/3600),a=Math.floor(t-3600*o),n=Math.floor(a/60),r=seconds%60;10>r&&(r="0"+r),new Date(s)<new Date&&($("#time").text(e+" Day(s) "+o+":"+n+":"+r),0>=seconds?(clearInterval(countdownTimer),$("#time").text("0 Day(s) 00:00:00")):seconds--)}var _second=1e3,_minute=60*_second,_hour=60*_minute,_day=24*_hour,e="{{ date('Y.m.d H:i:s', strtotime($userticket->expired_date)) }}",s="{{ date('Y.m.d H:i:s', strtotime($userticket->started_date)) }}";if(new Date(s)<=new Date)var distance=new Date(e)-new Date;else var distance=new Date(e)-new Date(s);var days=Math.floor(distance/_day),hours=Math.floor(distance%_day/_hour),minutes=Math.floor(distance%_hour/_minute),seconds=Math.floor(distance%_minute/_second),upgradeTime=86400*days+3600*hours+60*minutes+seconds,seconds=upgradeTime,days=Math.floor(seconds/24/60/60),hoursLeft=Math.floor(seconds-86400*days),hours=Math.floor(hoursLeft/3600),minutesLeft=Math.floor(hoursLeft-3600*hours),minutes=Math.floor(minutesLeft/60),remainingSeconds=seconds%60;10>remainingSeconds&&(remainingSeconds="0"+remainingSeconds),$("#time").text(days+" Day(s) "+hours+":"+minutes+":"+remainingSeconds),countdownTimer=setInterval(timer,1e3);
});
</script>
@endsection
@section('css')
<style>
.user-tickets-wrapper{width: 100%;margin: auto;border: 1px solid #000;float: left;}
.user-tickets-wrapper .item-container-wrapper{width: 96%;margin: auto;}
.user-tickets-wrapper .item-container{    margin: 1% 0;border: 1px solid #000;float: left;width: 100%;}
.user-tickets-wrapper .item-container .col1{width: 25%;margin: auto;float: left;}
.user-tickets-wrapper .item-container .col1 div{}
.user-tickets-wrapper .item-container .col1 label{}
.user-tickets-wrapper .item-container .col1 span{}
.user-tickets-wrapper .item-container .col1 button{}
button[disabled]{background: #fff;opacity: .7;}
</style>
@endsection


<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">{{trans('custom.head_detail_ticket_list')}}</div>
        <div class="panel-body">        
          <div class="user-tickets-wrapper">
          		<div>
          			<div>
	          			<div class="img-preview">
							<img src=""/>
						</div>
	          			<div class="ticket-name">
							<span>{{ $userticket->name }}</span>
						</div>
						<div class="purchase-info">
	          				<div>Purchase date: {{ date('Y.m.d', strtotime($userticket->purchase_date)) }}</div>
	          			</div>
          			</div>
          			<div>
          				<div>
		          			<div class="datetime-gap">
								<span>{{ date('Y.m.d', strtotime($userticket->started_date)) }}</span><span>-</span><span>{{ date('Y.m.d', strtotime($userticket->expired_date)) }}</span>
							</div>
							<div class="datetime-left">
								<label>{{trans('custom.detail_timeleft')}}</label><span id="time"></span>
							</div>
		          		</div>
          			</div>
          			<div>
          				<div class="next-line">
		          			<div>
								<div><label>{{trans('custom.adult')}}:</label><span>{{ $userticket->adult_num }}</span></div>
							</div>
							<div>
								<div><label>{{trans('custom.child')}}:</label><span>{{ $userticket->child_num }}</span></div>
							</div>
		          		</div>
          			</div>
          		</div>
 
