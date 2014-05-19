<?php
/*
*Copyright 2014 CheckoutCrypto and CheckoutCrypto Canada
*/
require('cc.php');



function getnewaddress($apikey, $coincode){
	$delay = 5;
    $ccApi = new CheckoutCryptoApi($apikey);
	$response = $ccApi->query(array('action' => 'getnewaddress','apikey' => $apikey, 'coin' => $coincode));  
	if($response['response']['status'] == "success" ){
		$queue = $response['response']['queue_id'];
		sleep($delay);
		$result = ccApiOrderStatus($apikey, 'getnewaddress', $queue);
		return $result;
	}
}

function getreceivedbyaddress($apikey, $address, $coincode){
	$delay = 5;
    $ccApi = new CheckoutCryptoApi($apikey);
	$response = $ccApi->query(array('action' => 'getreceivedbyaddress','apikey' => $apikey, 'address' => $address,'coin' => $coincode, 'confirms' => 1));  
	if($response['response']['status'] == "success" ){
		$queue = $response['response']['queue_id'];
		sleep($delay);
		$result = ccApiOrderStatus($apikey, 'getreceivedbyaddress', $queue);
		return $result;
	}
	else if($response['response']['status'] == "confirmed" ){
		$balance = array();
		$balance['balance'] = $response['response']['balance'];
		$balance['pending'] = $response['response']['pending'];
		$balance['fee'] = $response['response']['fee'];
		return $balance;
	}
}


function getbalance($apikey, $coincode){
	$delay = 5;
    $ccApi = new CheckoutCryptoApi($apikey);
	$response = $ccApi->query(array('action' => 'getbalance','apikey' => $apikey, 'coin' => $coincode));  
	if($response['response']['status'] == "success" ){
		$balance = $response['response']['balance'];
		return $balance;
	}
}

function refreshcoins($apikey, $coincode){
	$delay = 5;
    $ccApi = new CheckoutCryptoApi($apikey);
	$response = $ccApi->query(array('action' => 'refreshcoins','apikey' => $apikey));  
		$tmpl = array();
	if($response['response']['status'] == "success" ){
		$count = 0;
		foreach($response['response']['coins'] as $cn){
	 		$tmpCoin['coin_name'] = $cn['coin_name'];
	 		$tmpCoin['coin_code'] = $cn['coin_code'];
	 		$tmpCoin['rate'] = $cn['rate'];
	 		$tmpCoin['coin_image'] = $cn['coin_image'];
			array_push($tmpl, $tmpCoin);
			$count++;
		} 
		return $tmpl;
	}
}

function displayQrAddress($address){
         $url_qr_base = 'https://chart.googleapis.com/chart?cht=qr';
           $url_qr_args = '&chs=450';
           $url_qr_args .= '&choe=UTF8';
           $url_qr_args .= '&chld=L';
           $url_qr_args .= '&chl='.$address;
           $url_qr = $url_qr_base.$url_qr_args;
           $url_qr_output = '<div class="qr_layout"><img src="'.$url_qr.'"></div>';
			echo $url_qr_output;
}


function ccApiOrderStatus($apikey, $type, $queue){
 	$ccApi = new CheckoutCryptoApi($apikey);
	$response = $ccApi->query(array('action' => 'getstatus','apikey' => $apikey, 'orderid' => $queue));  
	switch($type){
		case 'getnewaddress':
			if($response['response']['status'] == "success" ){
				$address = $response['response']['address'];
				return $address;
			}
		break;
		case 'getreceivedbyaddress':
				$balance = array();
				$balance['status'] =  $response['response']['status'];

			if($balance['status']  == "pending" ){
				$balance['orderid'] =  $response['response']['orderid'];
			}else if($balance['status'] == "confirmed" ){
				$balance['status'] = $response['response']['status'];
				$balance['balance'] = $response['response']['balance'];
				$balance['pending'] = $balance['pending'];
				$balance['fee'] = $balance['fee'];
				return $balance;
			}
		break;
		case 'getbalance':
			if($response['response']['status'] == "success" ){
				$balance['status'] = $response['response']['status'];
				$balance['queue_id'] =  $response['response']['queueid'];
				$balance['sent_total'] = $response['response']['sent_total'];
				$balance['subtotal'] =$response['response']['subtotal'];
				$balance['txfee'] = $response['response']['txfee'];
				$balance['ccfee'] = $response['response']['ccfee'];
				$balance['balance_remaining'] = $response['response']['balance_remaining'];
				return $balance;
			}
		break;
	}
}  

?>
