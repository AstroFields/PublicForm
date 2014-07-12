<?php

namespace WCM\AstroFields\PublicForm\Views;


use WCM\AstroFields\Core\Receivers\LabelInterface;
use WCM\AstroFields\Core\Views\LabelAwareInterface;
use WCM\AstroFields\Core\Views\ViewableInterface;
use WCM\AstroFields\Core\Templates\TemplateInterface;

class LabelView implements ViewableInterface, LabelAwareInterface
{
	/** @type */
	public $data;

	/** @type TemplateInterface */
	private $template;

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