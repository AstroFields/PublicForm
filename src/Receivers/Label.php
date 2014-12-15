<?php

namespace WCM\AstroFields\PublicForm\Receivers;

use WCM\AstroFields\Core\Receivers\EntityProviderInterface;

class Label implements EntityProviderInterface
{
	/** @type Array */
	private $data;

	public function setData( Array $data )
	{
		$this->data = $data;
	}

	/**
	 * Retrieve the value for the `for=""` attribute
	 * to assign a label to a field
	 * @return string
	 */
	public function getKey()
	{
		return $this->data['key'];
	}

	/**
	 * Retrieve the value for the tag value
	 * @return string
	 */
	public function getValue()
	{
		return $this->data['value'];
	}
}