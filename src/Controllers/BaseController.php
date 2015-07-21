<?php

namespace MPWAR\Controllers;

use MPWAR\AppKernel;
use MPWAR\Request\Request;

abstract class BaseController
{
    protected $request;
    protected $app;
    protected $strings;

    public function __construct(Request $req, AppKernel $app, array $strings)
    {
        $this->request = $req;
        $this->app = $app;
        $this->strings = $strings;
    }
}
