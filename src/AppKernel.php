<?php

namespace MPWAR;

use MPWAR\Request\Request;
use MPWAR\Response\Response;
use MPWAR\Response\HttpResponse;
use MPWAR\Routing\Routing;
use MPWAR\Routing\Exceptions\UndefinedUrlException;
use MPWAR\Templating\TemplateAdapter;
use MPWAR\Response\View;

class AppKernel
{
    private $router;

    public function __construct(Routing $router, TemplateAdapter $templateAdapter)
    {
        $this->router = $router;
        View::setAdapter($templateAdapter);
    }

    public function handle(Request $req)
    {
        $response = $this->executeRequest($req);
        if ($response instanceof Response) {
            return $response;
        } else {
            return new HttpResponse($response);
        }
    }

    private function executeRequest(Request $req)
    {
        try {
            list($action, $args) = $this->router->getActionData($req);
            $controller_class = '\\Controllers\\'.$action['controller'];
            $controller_action = $action['action'];
            $controller = new $controller_class($req, $this);
            $response = call_user_func_array([$controller, $controller_action], $args);
            return $response;
        } catch (UndefinedUrlException $error) {
            return View::make('errors/404.html', [], 404);
        }
    }
}
