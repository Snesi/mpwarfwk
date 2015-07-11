<?php 

namespace MPWAR\Templating;

interface TemplateAdapter {

	public function render($template, array $args);

}