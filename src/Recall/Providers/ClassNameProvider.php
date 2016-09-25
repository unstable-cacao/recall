<?php
namespace Recall\Providers;


use Recall\Base\IRecallProvider;
use Recall\Exceptions\ParameterClassNotFoundException;


class ClassNameProvider implements IRecallProvider
{
	/** @var string */
	private $className;


	/**
	 * ClassNameProvider constructor.
	 * @param string $className
	 */
	public function __construct($className)
	{
		$this->className = $className;
	}


	/**
	 * @param \ReflectionParameter $parameter
	 * @return object
	 */
	public function get(\ReflectionParameter $parameter)
	{
		if (!class_exists($this->className))
			throw new ParameterClassNotFoundException($this->className, $parameter);
		
		return new $this->className;
	}
}