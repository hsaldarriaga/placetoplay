<?php

namespace Saldarriaga\placetopay\components;

use Saldarriaga\placetopay\components\Client;
use SoapClient;

class PTPSoapClient extends Client {

	private $client;
	private $dataForAllRequest;

	public function __constructor($wdsl) {
		$this->client = SoapClient($wsdl);
	}
	
	public function setDataForAllRequest($data) {
		$this->dataForAllRequest = $data;
	}

	public function call($function, $argument, $options = null) {
		return $this->client->__soapCall($function, [$data, $argument], $options);
	}


}