<?php

namespace Hsaldarriaga\placetopay\components;

use Hsaldarriaga\placetopay\components\Client;

class PTPSoapClient implements Client {

	private $client;
	private $dataForAllRequest;

	function __construct($wsdl) {
		$this->client = new \SoapClient($wsdl);
	}
	
	public function setDataForAllRequest($data) {
		$this->dataForAllRequest = $data;
	}

	public function call($function, $argument) {
		if (is_null($argument)) {
			$params = [$this->dataForAllRequest];
		} else {
			$params = [$this->dataForAllRequest, $argument];
		}
		if (is_null($argument)) {
			return $this->client->$function($this->dataForAllRequest);
		} else {
			return $this->client->$function(array_merge($this->dataForAllRequest, $argument));
		}
	}
}