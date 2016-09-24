<?php
namespace Recall;


use Recall\Base\IRecall;
use Recall\Base\IRecallProvider;


class Recall implements IRecall
{
	
	/**
	 * @param string $className
	 * @param object|IRecallProvider|\Closure|string $provider
	 * @return mixed
	 */
	public function register($className, $provider)
	{
		// TODO: Implement register() method.
	}
	
	/**
	 * @param object|string $class String for static call, instance of instance call.
	 * @param $method
	 * @return mixed
	 */
	public function call($class, $method)
	{
		// TODO: Implement call() method.
	}
}