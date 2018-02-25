<?php

namespace App;

use Layout\ILayout;

/**
 * Main application class that provides opportunities
 * for working with controllers.
 *
 * Class Application
 * @package App
 */
class Application
{
	private $__handlers = [];
	
	public function get($route, $handler)
	{
		$this->__append('GET', $route, $handler);
	}
	
	public function post($route, $handler)
	{
		$this->__append('POST', $route, $handler);
	}
	
	public function run(ILayout $layout)
	{
		$uri = $_SERVER['REQUEST_URI'];
		$method = $_SERVER['REQUEST_METHOD'];
		
		foreach ($this->__handlers as $item)
		{
			list($route, $handlerMethod, $handler) = $item;
			
			if ($method == $handlerMethod && preg_match("/^$route$/i", $uri))
			{
				$layout->drawLayout(array_merge(
					$handler()
				));
			}
		}
	}
	
	private function __append($method, $route, $handler)
	{
		$this->__handlers[] = [$route, $method, $handler];
	}
}