<?php
namespace Recall\Base;


interface IRecallProvider
{
	/**
	 * @param \ReflectionParameter $parameter
	 * @return object
	 */
	public function get(\ReflectionParameter $parameter);
}