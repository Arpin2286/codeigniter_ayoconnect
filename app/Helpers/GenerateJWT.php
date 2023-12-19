<?php

namespace App\Helpers;

use Exception;
use Firebase\JWT\JWT;

class GenerateJWT
{
    public static function generateToken($payload)
    {
        $data_payload['username'] = $payload;
        $current_time = time();
        $token_time = getenv('JWT_TO_TIME_LIVE');
        $expired_time = $current_time + $token_time;

        $data_payload['time_req'] = $current_time;
        $data_payload['exp'] = $expired_time;

        $jwt = JWT::encode($data_payload, getenv('JWT_SECRET_KEY'), 'HS256');
        return $jwt;
    }
}
