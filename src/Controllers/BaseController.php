<?php

namespace MPWAR\Controllers;

use MPWAR\AppKernel;
use MPWAR\Request\Request;

class BaseController {

	protected $request;
	protected $kernel;

	public function __construct(Request $req, AppKernel $app) {
		$this->request = $req;
		$this->kernel = $app;
	}

}