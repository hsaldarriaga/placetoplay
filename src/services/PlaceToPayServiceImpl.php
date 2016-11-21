<?php

namespace Hsaldarriaga\placetopay\services;

use Hsaldarriaga\placetopay\models\PSERequest;
use Hsaldarriaga\placetopay\models\PSEMultiCreditRequest;
use Hsaldarriaga\placetopay\models\Person;

use Hsaldarriaga\placetopay\components\Client;

class PlaceToPayServiceImpl implements PlaceToPayService 
{
	private $client;

	function __construct(Client $client) {
		$this->client = $client;
	}


	public function getBankList() {
		$response = $this->client->call('getBankList', null);
		$items = $response->getBankListResult->item;
		$converted = [];
		foreach($items as $item) {
			array_push($converted, $this->recast('Hsaldarriaga\placetopay\models\Bank', $item));
		}
		return $converted;
	}

	public function createTransaction(PSERequest $request, Person $payer, Person $buyer = null, Person $shipping = null) {
		$request->payer = $payer;
		$request->buyer = is_null($buyer) ? $payer : $buyer;
		$request->shipping = is_null($shipping) ? $payer: $shipping;
		if (is_null($request->ipAddress)) {
			$request->ipAddress = $_SERVER['REMOTE_ADDR'];
			$request->userAgent = $_SERVER['HTTP_USER_AGENT'];
		}
		$response = $this->client->call('createTransaction', ['transaction' => $request]);
		return $this->recast('Hsaldarriaga\placetopay\models\PSEResponse', $response->createTransactionResult);
	}

	public function createMultiCreditTransaction(PSEMultiCreditRequest $request, Person $payer, Person $buyer = null, Person $shipping = null) {
		$request->payer = $payer;
		$request->buyer = is_null($buyer) ? $payer : $buyer;
		$request->shipping = is_null($shipping) ? $payer: $shipping;
		if (is_null($request->ipAddress)) {
			$request->ipAddress = $_SERVER['REMOTE_ADDR'];
			$request->userAgent = $_SERVER['HTTP_USER_AGENT'];
		}
		$response = $this->client->call('createTransactionMultiCredit', ['transaction' => $request]);
		return $this->recast('Hsaldarriaga\placetopay\models\PSEResponse', $response->createTransactionMultiCreditResult);
	}

	public function getTransactionInformation($transactionID) {
		if (!is_int($transactionID)) {
			throw new \InvalidArgumentException('Only accept integer');
		}
		$response = $this->client->call('getTransactionInformation', ['transactionID' => $transactionID]);
		return $this->recast('Hsaldarriaga\placetopay\models\Information', $response->getTransactionInformationResult);
	}


	/**
	 * Taken from: http://stackoverflow.com/questions/3243900/convert-cast-an-stdclass-object-to-another-class
	 * recast stdClass object to an object with type
	 *
	 * @param string $className
	 * @param stdClass $object
	 * @throws InvalidArgumentException
	 * @return mixed new, typed object
	 */
	function recast($className, \stdClass &$object)
	{
	    if (!class_exists($className))
	        throw new InvalidArgumentException(sprintf('Inexistant class %s.', $className));

	    $new = new $className();

	    foreach($object as $property => &$value)
	    {
	        $new->$property = &$value;
	        unset($object->$property);
	    }
	    unset($value);
	    $object = (unset) $object;
	    return $new;
	}
}