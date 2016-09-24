<?php
namespace Recall;


use Recall\Base\IRecall;
use Recall\Base\IRecallProvider;
use Recall\Providers\InstanceProvider;


class Recall implements IRecall
{
	/** @var IRecallProvider[] */
	private $parameters;


	/**
	 * @param string $className
	 * @param object|IRecallProvider|\Closure|string $provider
	 * @return static
	 */
	public function register($className, $provider)
	{
		if ($provider instanceof IRecallProvider)
		{
			$this->parameters[$className] = $provider;
		}
		else if (is_object($provider))
		{
			$this->parameters[$className] = new InstanceProvider($provider);
		}
		
		return $this;
	}
	
	/**
	 * @param object|string $class String for static call, instance of instance call.
	 * @param string $method
	 * @return mixed
	 */
	public function call($class, $method)
	{
		$reflectionMethod = new \ReflectionMethod($class, $method);
		$parameters = [];

		foreach ($reflectionMethod->getParameters() as $parameter)
		{
			if (is_null($parameter->getClass()))
				throw new \Exception("Non class parameters are not supported");

			$className = $parameter->getClass()->getName();

			if (!key_exists($className, $this->parameters))
				throw new \Exception("No such parameter registered.");

			$parameters[] = $this->parameters[$className]->get($parameter);
		}

		return (is_string($class) ?
			$reflectionMethod->invoke(null, $parameters) :
			$reflectionMethod->invoke($class, $parameters));
	}
}