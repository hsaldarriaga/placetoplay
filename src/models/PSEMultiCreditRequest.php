<?php

namespace Saldarriaga\placetopay\models;

class PSEMultiCreditRequest extends PSERequest 
{

	public $creditConcept = [];

	public function add(CreditConcept $creditConcept) 
	{
		array_push($this->creditConcept, $creditConcept);
	}
}