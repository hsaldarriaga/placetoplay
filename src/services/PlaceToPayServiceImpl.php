<?php

namespace Saldarriaga\placetopay\services;

use Saldarriaga\placetopay\models\PSERequest;
use Saldarriaga\placetopay\models\PSEMultiCreditRequest;
use Saldarriaga\placetopay\models\Person;

use Saldarriaga\placetopay\components\Client;

class PlaceToPayServiceImpl extends PlaceToPayService 
{
	private $client;

	public function __constructor(Client $client) {
		$this->client = $client;
	}


	public function getBankList() {
		$response = $this->client->call('getBankList', null);
	}

	public function createTransaction(PSERequest $request, Person $payer, Person $buyer = null, Person $shipping = null) {
		$request->payer = $payer;
		$request->buyer = is_null($buyer) ? $payer : $buyer;
		$request->shipping = is_null($shipping) ? $payer: $shipping;
		if (is_null($request->ipAddress)) {
			$request->ipAddress = $_SERVER['REMOTE_ADDR'];
			$request->userAgent = $_SERVER['HTTP_USER_AGENT'];
		}
		$response = $this->client->call('createTransaction', ['transaction' => $request]);
		print_r($response);
		return $response;
	}

	public function createMultiCreditTransaction(PSEMultiCreditRequest $request, Person $payer, Person $buyer = null, Person $shipping = null) {
		$request->payer = $payer;
		$request->buyer = is_null($buyer) ? $payer : $buyer;
		$request->shipping = is_null($shipping) ? $payer: $shipping;
		if (is_null($request->ipAddress)) {
			$request->ipAddress = $_SERVER['REMOTE_ADDR'];
			$request->userAgent = $_SERVER['HTTP_USER_AGENT'];
		}
		$response = $this->client->call('createTransactionMultiCredit', ['transaction' => $request]);
		print_r($response);
		return $response;
	}

	public function getTransactionInformation($transactionID) {
		if (!is_int($transactionID)) {
			throw new \InvalidArgumentException('Only accept integer');
		}
		$response = $this->client->call('getTransactionInformation', ['transactionID' => $transactionID]);
		print_r($response);
		return $response;
	}
}