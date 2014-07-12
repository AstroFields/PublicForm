<?php

namespace WCM\AstroFields\PublicForm\Commands;

use WCM\AstroFields\Core\Commands\ContextAwareInterface;
use WCM\AstroFields\Core\Commands\ViewAwareInterface;
use WCM\AstroFields\Core\Receivers\FieldInterface;
use WCM\AstroFields\Core\Receivers\DataProviderInterface;
use WCM\AstroFields\Core\Views\ViewableInterface;
use WCM\AstroFields\Core\Templates\TemplateInterface;

use WCM\AstroFields\PublicForm\Views\EntityView as View;
use WCM\AstroFields\PublicForm\Receivers\Field;


class ViewCmd implements \SplObserver, ContextAwareInterface
{
	/** @var string */
	protected $context = '';

	/** @type ViewableInterface */
	protected $view;

	/** @type FieldInterface|DataProviderInterface */
	protected $receiver;

	/** @type TemplateInterface */
	protected $template;

	public function __construct()
	{
		$this->view     = new View;
		$this->receiver = new Field;
	}

	/**
	 * Receive update from subject
	 * @param \SplSubject $subject
	 * @param Array       $data
	 */
	public function update( \SplSubject $subject, Array $data = null )
	{
		$this->view->setTemplate( $this->template );

		$this->receiver->setData( $data );
		$this->view->setData( $this->receiver );

		$this->view->process();
	}

	public function setView( $view )
	{
		$this->view = $view;

		return $this;
	}

	public function setProvider( $receiver )
	{
		$this->receiver = $receiver;

		return $this;
	}

	public function setTemplate( TemplateInterface $template )
	{
		$this->template = $template;

		return $this;
	}

	public function setContext( $context )
	{
		$this->context = $context;

		return $this;
	}

	public function getContext()
	{
		return $this->context;
	}
}