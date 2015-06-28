<?php

namespace MPWAR\Controller;

class BaseController {

	protected $request;
	protected $kernel;

	public function __construct(Request $req, AppKernel $app) {
		$this->request = $req;
		$this->kernel = $app;
	}

}