<?php 

namespace MPWAR;

use MPWAR\Request;
use MPWAR\Response;
use MPWAR\Routing;

class AppKernel {

	public function handle(Request $req) {
		return new Response("lol");
	}

}