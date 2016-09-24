<?php
namespace Recall\Exceptions;


class MethodNotFoundException extends RecallException
{
	/**
	 * @param string|object $class
	 * @param string $methodName
	 */
	public function __construct($class, $methodName)
	{
		$className = (is_string($class) ? $class : get_class($class));
		parent::__construct("Method $methodName was not found in class $className");
	}
}