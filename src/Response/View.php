<?php

namespace MPWAR\Response;

use MPWAR\Templating\TemplateAdapter;
use MPWAR\Templating\TemplatingException;

class View
{
    private static $adapter;

    public static function make($name, array $args = [], $status = 200)
    {
        try {
            $view = self::$adapter->render($name, $args);

            return new HttpResponse($view, $status);
        } catch (TemplatingException $e) {
            $view = self::$adapter->render('errors/500.html', []);

            return new HttpResponse($view, $status);
        }
    }

    public static function setAdapter(TemplateAdapter $adapter)
    {
        self::$adapter = $adapter;
    }
}
