<?php

namespace Hsaldarriaga\placetopay\components;

use SoapClient;

interface Client {
	
	public function setDataForAllRequest($data);

	public function call($function, $argument);
}