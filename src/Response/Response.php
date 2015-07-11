<?php
namespace MPWAR\Response;

class Response
{
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function send()
    {
        echo $this->content;
    }
}
