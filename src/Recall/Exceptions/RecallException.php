<?php
namespace Recall\Exceptions;


class RecallException extends \Exception
{
	/**
	 * @param string $message
	 */
	public function __construct($message)
	{
		parent::__construct($message, 0, null);
	}
}