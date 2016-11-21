<?php


namespace Hsaldarriaga\placetopay\models;

class Attribute {
	public $name;
	public $value;

	function __construct($name, $value) {
		$this->name = $name;
		$this->value = $value;
	}
}