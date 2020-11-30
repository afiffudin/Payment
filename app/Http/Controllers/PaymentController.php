<?php

namespace App\Http\Controllers;

use App\Veritrans\Midtrans;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PaymentController extends Controller
{
	public function __construct()
	{
		Veritrans::$serverKey = 'SB-Mid-server-BXZqRYO9KQUw7BkoO8CJK_H-';
		Veritrans::$isProduction = false;
	}
	public function token()
	{
		error_log('masuk ke snap token adri ajax');
		$midtrans = new Midtrans();
		$transaction_details = array(
			'order_id'          => uniqid('local', true),
			'gross_amount'  => 200000
		);
		// Populate items
		$items = [
			array(
				'id'                => 'item1',
				'price'         => 100000,
				'quantity'  => 1,
				'name'          => 'Adidas f50'
			),
			array(
				'id'                => 'item2',
				'price'         => 50000,
				'quantity'  => 2,
				'name'          => 'Nike N90'
			)
		];
		// Populate customer's billing address
		$billing_address = array(
			'first_name'        => "Andri",
			'last_name'         => "Setiawan",
			'address'           => "Karet Belakang 15A, Setiabudi.",
			'city'                  => "Jakarta",
			'postal_code'   => "51161",
			'phone'                 => "081322311801",
			'country_code'  => 'IDN'
		);
		// Populate customer's shipping address
		$shipping_address = array(
			'first_name'    => "John",
			'last_name'     => "Watson",
			'address'       => "Bakerstreet 221B.",
			'city'              => "Jakarta",
			'postal_code' => "51162",
			'phone'             => "081322311801",
			'country_code' => 'IDN'
		);
		// Populate customer's Info
		$customer_details = array(
			'first_name'            => "Andri",
			'last_name'             => "Setiawan",
			'email'                     => "andrisetiawan@asdasd.com",
			'phone'                     => "081322311801",
			'billing_address' => $billing_address,
			'shipping_address' => $shipping_address
		);
		// Data yang akan dikirim untuk request redirect_url.
		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'           => $items,
			'customer_details'   => $customer_details
		);

		try {
			$snap_token = $midtrans->getSnapToken($transaction_data);
			//return redirect($vtweb_url);
			echo $snap_token;
		} catch (Exception $e) {
			return $e->getMessage;
		}
	}
}
