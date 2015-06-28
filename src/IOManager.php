<?php

namespace MPWAR;

use MPWAR\Request\Request;
use MPWAR\Response\Response;

class IOManager {

	public static function captureHttpRequest() {
		return new Request();
	}

	public static function sendHttpResponse(Response $response, array $headers = null) {
		$response->send();
	}
}