<?php

namespace MPWAR\Templating;

class SmartyAdapter implements TemplateAdapter
{
    private $smarty;

    public function __construct($smartyEnv)
    {
        $this->smarty = $smartyEnv;
    }

    public function render($template, array $args)
    {
        $this->smarty->assign($args);
        try {
            return $this->smarty->display($template);
        } catch (\Exception $error) {
            dd($error);
            throw new TemplatingException("template doesn't exist");
        }
    }
}
