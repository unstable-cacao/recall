<?php
namespace Recall;


use Recall\Base\IRecallProvider;
use Recall\Providers\CallbackProvider;
use Recall\Providers\ClassNameProvider;
use Recall\Providers\InstanceProvider;


class ProvidersFactory
{
	/**
	 * @param object|IRecallProvider|\Closure|string $provider
	 * @return IRecallProvider
	 */
	public static function get($provider)
	{
		if ($provider instanceof IRecallProvider)
		{
			return $provider;
		}
		else if (is_callable($provider))
		{
			return new CallbackProvider($provider);
		}
		else if (is_object($provider))
		{
			return new InstanceProvider($provider);
		}
		else if (is_string($provider))
		{
			if (is_subclass_of($provider, IRecallProvider::class))
			{
				return new $provider;
			}
			
			return new ClassNameProvider($provider);
		}

		throw new \Exception("No provider found");
	}
}