<?php

namespace Hsaldarriaga\placetopay\models;

class PSERequest {

	public $bankCode;
	public $bankInterface;
	public $returnURL;
	public $reference;
	public $description;
	public $language;
	public $currency;
	public $totalAmount;
	public $taxAmount;
	public $devolutionBase;
	public $tipAmount;

	public $ipAdress;
	public $userAgent;

	private $additionalData = [];


	public function add(Attribute $data) 
	{
		array_push($this->additionalData, $data);
	}
}