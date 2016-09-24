<?php
namespace Recall\Exceptions;


class ProviderNotDefinedException extends RecallException
{
	/**
	 * @param string|object $class
	 * @param string $method
	 * @param \ReflectionParameter $parameter
	 */
	public function __construct($class, $method, \ReflectionParameter $parameter)
	{
		$className = (is_string($class) ? $class : get_class($class));
		$parameterName = $parameter->getName();
		
		parent::__construct("Could not resolve parameter $parameterName " . 
			"when trying to recall method $className::$className");
	}
}