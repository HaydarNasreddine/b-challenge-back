<?php

namespace App\Helpers;


class HTTPResponse
{
    public static function ok($data = null)
    {
        $response = [
            "status" => HTTPCode::SUCCESS,
        ];
        if($data) $response['data'] = $data;
        
        return response()->json($response, 200);
    }
}
