<?php

namespace Saldarriaga\placetopay;

use Saldarriaga\placetopay\components\PTPSoapClient;
use Saldarriaga\placetopay\services\PlaceToPayServiceImpl;

use Saldarriaga\placetopay\components\Client;

abstract class PlaceToPayFactory {

	public static function getService(Client $client) {
		return new PlaceToPayServiceImpl($client);
	} 

	public static function getClient($param) {
		return new PTPSoapClient($param);
	}
}