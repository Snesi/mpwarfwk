<?php

namespace MPWAR;

use MPWAR\Request\Request;
use MPWAR\Response\Response;
use MPWAR\Routing\Routing;
use MPWAR\Templating\TemplateAdapter;
use MPWAR\Templating\View;

class AppKernel
{
    
    private $router;
    
    public function __construct(Routing $router, TemplateAdapter $templateAdapter) {
        $this->router = $router;
        View::setAdapter($templateAdapter);
    }
    
    public function handle(Request $req) {
        $response = $this->executeRequest($req);
        return new Response($response);
    }
    
    private function executeRequest(Request $req) {
        list($action, $args) = $this->router->getActionData($req);

        $controller_class = "\\Controllers\\" . $action["controller"];
        $controller_action = $action["action"];
        
        $controller = new $controller_class($req, $this);
        return call_user_func_array([$controller, $controller_action], $args);
    }
}
