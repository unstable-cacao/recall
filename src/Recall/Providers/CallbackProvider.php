<?php
namespace Recall\Providers;


use Recall\Base\IRecallProvider;


class CallbackProvider implements IRecallProvider
{
	/** @var \Closure */
	private $callback;
	
	
	/**
	 * CallbackProvider constructor.
	 * @param \Closure $callback
	 */
	public function __construct($callback)
	{
		$this->callback = $callback;
	}
	
	
	/**
	 * @param \ReflectionParameter $parameter
	 * @return object
	 */
	public function get(\ReflectionParameter $parameter)
	{
		$callback = $this->callback;
		return $callback($parameter);
	}
}