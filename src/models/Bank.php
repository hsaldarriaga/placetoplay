<?php

namespace Saldarriaga\placetopay\models;

class Bank {
	
	public $bankCode;
	public $bankName;

	public function __constructor($bankCode, $bankName) {
		$this->$bankCode = $bankCode;
		$this->$bankName = $bankName;
	}
}