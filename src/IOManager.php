<?php

namespace MPWAR;

use MPWAR\Request;
use MPWAR\Response;

class IOManager {

	public static function captureHttpRequest() {
		return new Request();
	}

	public static function sendHttpResponse(Response $response, array $headers = null) {
		$response->send();
	}
}