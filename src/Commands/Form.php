<?php

namespace WCM\AstroFields\PublicForm\Commands;

use WCM\AstroFields\Core\Commands\ContextAwareInterface;
use WCM\AstroFields\Core\Receivers\DataReceiverInterface;
use WCM\AstroFields\Core\Templates\TemplateInterface;
use WCM\AstroFields\Core\Commands\ViewAwareInterface;

class Form implements \SplObserver, ViewAwareInterface, ContextAwareInterface
{
	/** @type string */
	private $context = '';

	/** @type string */
	private $key;

	/** @type array $types */
	private $types;

	/** @type \SplPriorityQueue|mixed */
	private $receiver;

	/** @type TemplateInterface */
	private $template;

	public function __construct( TemplateInterface $template )
	{
		$this->template = $template;
		$this->receiver = new \SplPriorityQueue;
		$this->receiver->setExtractFlags( \SplPriorityQueue::EXTR_DATA );
	}

	/**
	 * Receive update from subject
	 * @param \SplSubject $subject
	 * @param Array       $data
	 */
	public function update( \SplSubject $subject, Array $data = null )
	{
		$this->key   = $data['key'];
		$this->types = $data['type'];

		$this->template->attach( $this->receiver );
		$this->template->display();
	}

	/**
	 * Attach a \SplSubject
	 * @param \SplSubject $command
	 * @param int         $priority
	 * @return $this|void
	 */
	public function attach( \SplSubject $command, $priority = 0 )
	{
		$this->receiver->insert( $command, $priority );

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

	public function setTemplate( TemplateInterface $template )
	{
		$this->template = $template;

		return $this;
	}

	public function setProvider( DataReceiverInterface $receiver )
	{
		$this->receiver = $receiver;

		return $this;
	}
}