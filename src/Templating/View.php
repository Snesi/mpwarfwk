<?php  

namespace MPWAR\Templating;

use MPWAR\Templating\TemplateAdapter;
use MPWAR\Templating\TemplatingException;

class View {

	private static $adapter;

	public static function make($name, array $args) {
		try {
			return self::$adapter->render($name, $args);	
		} catch (TemplatingException $e) {
			return self::$adapter->render("errors/500.html", []);
		}
		
	}

	public static function setAdapter(TemplateAdapter $adapter) {
		self::$adapter = $adapter;
	}

}