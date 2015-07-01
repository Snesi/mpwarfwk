<?php

namespace MPWAR;

use MPWAR\Request\Request;
use MPWAR\Response\Response;
use MPWAR\Routing\Routing;

class AppKernel
{
    
    private $router;
    
    public function __construct(Routing $router) {
        $this->router = $router;
    }
    
    public function handle(Request $req) {
        $response = $this->executeAction($req);
        
        return new Response("");
    }
    
    private function executeAction(Request $req) {
        list($action, $args) = $this->router->getActionData($req);

        $controller_class = "\\Controllers\\" . $action["controller"];
        $controller_action = $action["action"];
        
        //$viewGenerator = new View($this->templateEngine, $this->cacheEngine, 5);
        $controller = new $controller_class($req, $this);
        if(!isset($args)) $args = [];
        return call_user_func_array([$controller, $controller_action], $args);
    }
}
