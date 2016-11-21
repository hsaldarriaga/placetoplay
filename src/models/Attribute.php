<?php


namespace Saldarriaga\placetopay\models;

class Attribute {
	public $name;
	public $value;

	function __constructor($name, $value) {
		$this->name = $name;
		$this->value = $value;
	}
}