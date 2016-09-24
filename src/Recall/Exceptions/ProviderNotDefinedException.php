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
		parent::__construct("");
	}
}