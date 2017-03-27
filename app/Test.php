<?php  
namespace App;
use App\ApiModel;

class Test {

	public function __construct(ApiModel $api) {
		$this->api = $api;
	}

	public function reIssueToken($data) {
		$res = $this->api->callByAuth('POST',env('API_URL', false).'/v1/auth/refresh',$data);
        if($res->getStatusCode() != 200){
            return false;
        }
        return json_decode($res->getBody());
	}
	public function getUserTicketList($param1) {
		$res 	= $this->api->callByAuth('GET',env('API_URL', false).'/v1/users/'.$param1.'/tickets');
        if($res->getStatusCode() != 200){
            return false;
        }
        return json_decode($res->getBody());
	}
	public function getUserTicketDetail($param1,$param2) {
		$res 	= $this->api->callByAuth('GET',env('API_URL', false).'/v1/users/'.$param1.'/tickets/'.$param2);
		if($res->getStatusCode() != 200){
            return false;
        }
        return json_decode($res->getBody());
	}
	public function getReceivingTicketDetail($param1) {
		$res 	= $this->api->callByAuth('GET',env('API_URL', false).'/v1/split_tickets/'.$param1);
        if($res->getStatusCode() != 200){
            return false;
        }
        return json_decode($res->getBody());
	}
	public function postPurchaseTicket($data,$param1) {
		$res = $this->api->callByAuth('POST',env('API_URL', false).'/v1/users/'.$param1.'/tickets/purchase',$data);
        if($res->getStatusCode() != 200){
            return false;
        }
        return json_decode($res->getBody());
	}
	public function postSplitTicket($data,$param1,$param2) {
		$res = $this->api->callByAuth('POST',env('API_URL', false).'/v1/users/'.$param1.'/tickets/'.$param2.'/split',$data);
        if($res->getStatusCode() != 200){
            return false;
        }
        return json_decode($res->getBody());
	}
    public function postReceiveTicket($data,$param1) {
        $res = $this->api->callByAuth('POST',env('API_URL',false).'/users/'.$param1.'/tickets/receive',$data);
        if($res->getStatusCode() != 200) {
            return false;
        }
        return json_decode($res->getBody());
    }
    public function postStartTicket($param1,$param2) {
        $res = $this->api->callByAuth('POST',env('API_URL', false).'/v1/users/'.$param1.'/tickets/'.$param2.'/use');
        if($res->getStatusCode() != 200){
            return false;
        }
        return json_decode($res->getBody());
    }

}

?>