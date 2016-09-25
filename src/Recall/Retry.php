<?php
namespace Recall;


use Recall\Exceptions\RecallException;


class Retry
{
	/** @var \Closure */
	private $callback;
	
	/** @var \Closure */
	private $exceptionHandler = null;
	
	
	/**
	 * @param int $retries
	 * @param \Exception $e
	 */
	private function handleException($retries, \Exception $e)
	{
		if ($retries == 0)
		{
			throw $e;
		}
		
		if ($this->exceptionHandler)
		{
			$handler = $this->exceptionHandler;
			
			if ($handler($e) === false)
			{
				throw $e;
			}
		}
	}
	
	
	/**
	 * @param \Closure $callback
	 * @return static
	 */
	public function setCallback($callback)
	{
		$this->callback = $callback;
		return $this;
	}
	
	/**
	 * @param \Closure $handler
	 * @return static
	 */
	public function setExceptionHandler($handler)
	{
		$this->exceptionHandler = $handler;
		return $this;
	}
	
	
	/** @noinspection PhpInconsistentReturnPointsInspection */
	/**
	 * @param int $retries
	 * @return mixed
	 */
	public function call($retries = -1)
	{
		$callback = $this->callback;
		
		if (!$callback)
			throw new RecallException('Callback method was not set. See Retry::setCallback');
		
		while (true)
		{
			$retries = ($retries < 0 ? -1 : $retries - 1);
			
			try
			{
				return $callback();
			}
			catch (\Exception $e)
			{
				$this->handleException($retries, $e);
			}
		}
	}
	
	
	/**
	 * @return static
	 */
	public static function create()
	{
		return new Retry();
	}
}