<?php

namespace MPWAR\Templating;

class TwigAdapter implements TemplateAdapter
{
    private $twig;

    public function __construct($twigEnv)
    {
        $this->twig = $twigEnv;
    }

    public function render($template, array $args)
    {
        try {
            return $this->twig->render($template, $args);
        } catch (\Twig_Error_Loader $error) {
            throw new TemplatingException("template doesn't exist");
        }
    }
}
