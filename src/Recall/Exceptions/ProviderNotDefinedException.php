<?php
namespace Recall\Exceptions;


class ProviderNotDefinedException extends RecallException
{
	/**
	 * @param \ReflectionMethod $method
	 * @param \ReflectionParameter $parameter
	 */
	public function __construct(\ReflectionMethod $method, \ReflectionParameter $parameter)
	{
		$parameterName = $parameter->getName();
		
		parent::__construct("Could not resolve parameter $parameterName " . 
			"when trying to recall method {$method->getDeclaringClass()->getName()}::{$method->getName()}");
	}
}