<?php

namespace Saldarriaga\placetopay\components;

use SoapClient;

interface Client {
	
	public function setDataForAllRequest($data);

	public function call($function, $argument,  $options = null);
}