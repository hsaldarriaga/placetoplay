<?php

namespace Hsaldarriaga\placetopay\models;

class PSEResponse {

	public $transactionID;
	public $sessionID;
	public $returnCode;
	public $trazabilityCode;
	public $transactionCycle;
	public $bankCurrency;
	public $bankFactor;
	public $bankURL;
	public $responseCode;
	public $responseReasonCode;
	public $responseReasonText;
}