<?php

namespace Hsaldarriaga\placetopay;

use Hsaldarriaga\placetopay\components\PTPSoapClient;
use Hsaldarriaga\placetopay\services\PlaceToPayServiceImpl;

use Hsaldarriaga\placetopay\components\Client;

abstract class PlaceToPayFactory {

	public static function getService(Client $client) {
		return new PlaceToPayServiceImpl($client);
	} 

	public static function getClient($param) {
		return new PTPSoapClient($param);
	}
}