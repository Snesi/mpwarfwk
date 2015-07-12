<?php

namespace MPWAR\Response;

class HttpResponse implements Response
{
    protected $content;
    protected $status;

    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_SERVICE_UNAVAILABLE = 503;

    public static $statusTexts = array(
        200 => 'OK',
        201 => 'Created',
        301 => 'Moved Permanently',
        304 => 'Not Modified',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        503 => 'Service Unavailable'
    );

    public function __construct($content, $status = 200)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public function send()
    {
        if ($this->status != self::HTTP_OK && $this->status != self::HTTP_NOT_MODIFIED) {
            header('HTTP/1.0 404 Not Found');
        }
        if ($this->status == self::HTTP_NOT_MODIFIED) {
            header('HTTP/1.1 304 Not Modified');

            return;
        }

        return $this->content;
    }
}
