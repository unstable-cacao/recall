<?php
namespace Recall\Base;


interface IRecall
{
	/**
	 * @param string $className
	 * @param object|IRecallProvider|\Closure|string $provider
	 * @return static
	 */
	public function register($className, $provider);
	
	/**
	 * @param object|string $class String for static call, instance of instance call.
	 * @param string $method
	 * @return mixed
	 */
	public function call($class, $method);
}