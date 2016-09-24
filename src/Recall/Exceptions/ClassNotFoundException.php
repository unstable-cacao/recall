<?php
namespace Recall\Exceptions;


class ClassNotFoundException extends RecallException
{
	/**
	 * @param string $className
	 */
	public function __construct($className)
	{
		parent::__construct("Class $className does not exists");
	}
}