<?php
namespace Recall\Providers;


use Recall\Base\IRecallProvider;


class InstanceProvider implements IRecallProvider
{
	private $instance;
	
	
	/**
	 * @param mixed $instance
	 */
	public function __construct($instance)
	{
		$this->instance = $instance;
	}
	
	
	/**
	 * @param \ReflectionParameter $parameter
	 * @return object
	 */
	public function get(\ReflectionParameter $parameter)
	{
		return $this->instance;
	}
}