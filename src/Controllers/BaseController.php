<?php

namespace MPWAR\Controllers;

use MPWAR\AppKernel;
use MPWAR\Request\Request;

abstract class BaseController
{
    protected $request;
    protected $app;

    public function __construct(Request $req, AppKernel $app)
    {
        $this->request = $req;
        $this->app = $app;
    }
}
