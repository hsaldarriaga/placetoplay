<?php

namespace Saldarriaga\placetopay;

use Saldarriaga\placetopay\models\Authentication;
use Saldarriaga\placetopay\models\PSERequest;
use Saldarriaga\placetopay\models\PSEMultiCreditRequest;
use Saldarriaga\placetopay\models\Person;

use Saldarriaga\placetopay\services\PlaceToPayService;

use Saldarriaga\placetopay\components\Client;

class Transaction {

	private $auth;
	private $client;
	private $service;

	public function __constructor($wsdl, $login, $tranKey, $additionalAuthData) {
		$this->client = PlaceToPayFactory::getClient($wsdl);
		$this->service = PlaceToPayFactory::getService($this->client);
		$this->auth = new Authentication;
		$auth->login = $login;
		$auth->additional = $additionalAuthData;
	}

	private function updateSeed() {
		$seed = date('c'); 
		$hashString = sha1($seed . $tranKey, false);
		$auth->tranKey = $hashString;
		$auth->seed = $seed;
		$client->setDataForAllRequest(['auth' => $auth]);
	}

	public function getBankList() {
		$this->updateSeed();
		return $this->service->getBankList();
	}

	public function createTransaction(PSERequest $request, Person $payer, Person $buyer = null, Person $shipping = null) {
		$this->updateSeed();
		return $this->service->createTransaction($request, $payer, $buyer, $shipping);
	}

	public function createMultiCreditTransaction(PSEMultiCreditRequest $request, Person $payer, Person $buyer = null, Person $shipping = null) {
		$this->updateSeed();
		return $this->service->createMultiCreditTransaction($request, $payer, $buyer, $shipping);
	}

	public function getTransactionInformation($transactionID) {
		$this->updateSeed();
		return $this->service->getTransactionInformation($transactionID);
	}
}