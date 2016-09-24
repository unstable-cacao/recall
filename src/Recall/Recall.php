<?php
namespace Recall;


use Recall\Base\IRecall;
use Recall\Base\IRecallProvider;
use Recall\Exceptions\ClassNotFoundException;
use Recall\Exceptions\MethodNotFoundException;
use Recall\Exceptions\ProviderNotDefinedException;
use Recall\Exceptions\RecallException;


class Recall implements IRecall
{
	/** @var IRecallProvider[] */
	private $parameters;


	private function __construct() {}


	/**
	 * @param object|string $class String for static call, instance of instance call.
	 * @param string $method
	 * @return \ReflectionMethod
	 */
	private function getMethod($class, $method)
	{
		try
		{
			$class =  new \ReflectionClass($class);
		}
		catch (\ReflectionException $e)
		{
			throw new ClassNotFoundException($class);
		}

		try
		{
			return $class->getMethod($method);
		}
		catch (\ReflectionException $e)
		{
			throw new MethodNotFoundException($class, $method);
		}
	}

	/**
	 * @param \ReflectionMethod $reflectionMethod
	 * @return array
	 */
	private function getParameters(\ReflectionMethod $reflectionMethod)
	{
		$parameters = [];

		foreach ($reflectionMethod->getParameters() as $parameter)
		{
			if (is_null($parameter->getClass()))
				throw new RecallException("Non class parameters are not supported");

			$className = $parameter->getClass()->getName();

			if (!key_exists($className, $this->parameters))
				throw new ProviderNotDefinedException($reflectionMethod, $parameter);

			$parameters[] = $this->parameters[$className]->get($parameter);
		}

		return $parameters;
	}


	/**
	 * @param string $className
	 * @param object|IRecallProvider|\Closure|string $provider
	 * @return static
	 */
	public function register($className, $provider)
	{
		$this->parameters[$className] = ProvidersFactory::get($provider);
		return $this;
	}
	
	/**
	 * @param object|string $class String for static call, instance of instance call.
	 * @param string $method
	 * @return mixed
	 */
	public function call($class, $method)
	{
		$reflectionMethod = $this->getMethod($class, $method);
		$parameters = $this->getParameters($reflectionMethod);

		return (is_string($class) ?
			$reflectionMethod->invoke(null, $parameters) :
			$reflectionMethod->invoke($class, $parameters));
	}


	/**
	 * @return Recall
	 */
	public static function create()
	{
		return new Recall();
	}
}