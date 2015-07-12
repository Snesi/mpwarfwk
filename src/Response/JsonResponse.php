<?php

namespace MPWAR\Response;

class JsonResponse extends HttpResponse
{
    const HTTP_JSON_HEADER = 'Content-Type: application/json';

    public function send()
    {
        $content = parent::send();
        header(self::HTTP_JSON_HEADER);

        return json_encode($content);
    }
}
