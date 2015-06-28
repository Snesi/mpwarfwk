<?php 

namespace MPWAR;

use MPWAR\Request;
use MPWAR\Response;
use MPWAR\Routing;

class AppKernel {

	private $router;

	public function __construct(Routing $routes) {
		
	}

	public function handle(Request $req) {
		return new Response("lol");
	}

}