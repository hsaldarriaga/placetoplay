<?php

namespace Hsaldarriaga\placetopay;

use Hsaldarriaga\placetopay\models\Authentication;
use Hsaldarriaga\placetopay\models\PSERequest;
use Hsaldarriaga\placetopay\models\PSEMultiCreditRequest;
use Hsaldarriaga\placetopay\models\Person;

use Hsaldarriaga\placetopay\services\PlaceToPayService;

use Hsaldarriaga\placetopay\components\Client;

class Transaction {

	private $tranKey;
	private $auth;
	private $client;
	private $service;

	function __construct($wsdl, $login, $tranKey, $additionalAuthData = null) {
		$this->tranKey = $tranKey;
		$this->client = PlaceToPayFactory::getClient($wsdl);
		$this->service = PlaceToPayFactory::getService($this->client);
		$this->auth = new Authentication;
		$this->auth->login = $login;
		$this->auth->additional = $additionalAuthData;
	}

	private function updateSeed() {
		$seed = date('c'); 
		$hashString = sha1($seed . $this->tranKey, false);
		$this->auth->tranKey = $hashString;
		$this->auth->seed = $seed;
		$this->client->setDataForAllRequest(['auth' => $this->auth]);
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