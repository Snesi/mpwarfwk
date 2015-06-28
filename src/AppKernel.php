<?php 

namespace MPWAR;

use MPWAR\Request\Request;
use MPWAR\Response\Response;
use MPWAR\Routing\Routing;

class AppKernel {

	private $router;

	public function __construct(Routing $routes) {
		
	}

	public function handle(Request $req) {
		return new Response("lol");
	}

}