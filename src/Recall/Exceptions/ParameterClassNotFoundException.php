<?php
namespace Recall\Exceptions;


class ParameterClassNotFoundException extends RecallException
{
	/**
	 * @param string $className
	 * @param \ReflectionParameter $parameter
	 */
	public function __construct($className, \ReflectionParameter $parameter)
	{
		$methodName = $parameter->getDeclaringFunction()->getName();
		$className = $parameter->getDeclaringClass()->getName();
		
		parent::__construct("Could not find class '$className' when resolving parameter '{$parameter->name}' " .
			"in method {$className}::{$methodName}");
	}
}