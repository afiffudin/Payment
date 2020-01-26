<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PaymentController extends Controller
{
	public function getPayment(){
		$client = new Client();
	    try {
	    	$res = $client->request('GET','http://localhost:8001/coba', []);
			$data = json_decode($res->getBody()->getContents());
			return view('payment',['token'=> $data->token]);
	    } catch (Exception $e) {
	    	dd($e->getMessage());
	    }
	}
    
}
