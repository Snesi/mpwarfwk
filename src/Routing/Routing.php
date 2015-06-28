<?php

namespace MPWAR\Routing;

use MPWAR\Routing\Route;

class Routing {

	private $routes;

	public function __construct(array $routes) {
		$this->routes = [];
		foreach($routes as $route) {
			$this->routes = array_merge($this->routes, $route->toArray());
		}
	}
	
}