<?php

namespace Saldarriaga\placetopay\services;

use Saldarriaga\placetopay\models\PSERequest;
use Saldarriaga\placetopay\models\PSEMultiCreditRequest;
use Saldarriaga\placetopay\models\Person;

interface PlaceToPayService 
{
	public function getBankList();

	public function createTransaction(PSERequest $request, Person $payer, Person $buyer = null, Person $shipping = null);

	public function createMultiCreditTransaction(PSEMultiCreditRequest $request, Person $payer, Person $buyer = null, Person $shipping = null);

	public function getTransactionInformation($transactionID);
}