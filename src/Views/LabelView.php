<?php

namespace WCM\AstroFields\PublicForm\Views;


use WCM\AstroFields\Core\Receivers\LabelInterface;
use WCM\AstroFields\Core\Views\LabelAwareInterface;
use WCM\AstroFields\Core\Views\ViewableInterface;
use WCM\AstroFields\Core\Templates\TemplateInterface;
use WCM\AstroFields\Core\Templates\PrintableInterface;

class LabelView implements ViewableInterface, LabelAwareInterface
{
	/** @type */
	public $data;

	/** @type TemplateInterface|PrintableInterface */
	private $template;

	/**
	 * @param TemplateInterface $template
	 * @return $this
	 */
	public function setTemplate( TemplateInterface $template )
	{
		$this->template = $template;

		return $this;
	}

	public function setData( LabelInterface $data )
	{
		$this->data = $data;

		return $this;
	}

	public function process()
	{
		$this->template->attach( $this->data );

		echo $this->template;
	}
}