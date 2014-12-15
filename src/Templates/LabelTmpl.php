<?php

namespace WCM\AstroFields\PublicForm\Templates;

use WCM\AstroFields\Core\Receivers\AttributeAwareInterface;
use WCM\AstroFields\Core\Receivers\EntityProviderInterface;
use WCM\AstroFields\Core\Templates\PrintableInterface;
use WCM\AstroFields\Core\Templates\TemplateInterface;

class LabelTmpl implements TemplateInterface, PrintableInterface
{
	/** @type AttributeAwareInterface|EntityProviderInterface */
	private $data;

	/**
	 * @param AttributeAwareInterface|EntityProviderInterface $data
	 * @return $this
	 */
	public function attach( $data )
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * @return string
	 */
	public function display()
	{
		return $this->getMarkUp();
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->display();
	}

	/**
	 * Return the MarkUp
	 * @return string
	 */
	public function getMarkUp()
	{
		return <<<EOF
<label for="{$this->data->getKey()}">
	{$this->data->getValue()}
</label>
EOF;
	}
}