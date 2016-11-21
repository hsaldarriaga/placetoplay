<?php

namespace Hsaldarriaga\placetopay\services;

use Hsaldarriaga\placetopay\models\PSERequest;
use Hsaldarriaga\placetopay\models\PSEMultiCreditRequest;
use Hsaldarriaga\placetopay\models\Person;

interface PlaceToPayService 
{
	public function getBankList();

	public function createTransaction(PSERequest $request, Person $payer, Person $buyer = null, Person $shipping = null);

	public function createMultiCreditTransaction(PSEMultiCreditRequest $request, Person $payer, Person $buyer = null, Person $shipping = null);

	public function getTransactionInformation($transactionID);
}