<?php

namespace MPWAR\Controllers;

use MPWAR\AppKernel;
use MPWAR\Request\Request;

class BaseController {

	protected $request;
	protected $app;

	public function __construct(Request $req, AppKernel $app) {
		$this->request = $req;
		$this->app = $app;
	}

}