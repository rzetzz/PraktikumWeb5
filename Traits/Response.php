<?php

namespace Traits;

trait Response
{
    public function apiResponse($code =200, $message = "succes", $data = [])
    {
        return json_encode([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ]);
    }
}