<?php

namespace App\Middleware;

use App\Helpers\JWT;

class AuthMiddleware
{
  public static function handle($request)
  {
    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
      throw new \Exception('Unauthorized');
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);
    $user = JWT::validateJWT($token);

    return $user;
  }
}
