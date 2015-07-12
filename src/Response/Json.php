<?php

namespace MPWAR\Response;

class Json
{
    public static function make(array $json, $status = 200)
    {
        return new JsonResponse($json, $status);
    }
}
