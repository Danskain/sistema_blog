<?php

namespace App\Helpers;

use Firebase\JWT\JWT as FirebaseJWT;

class JWT
{
  private static $secretKey = 'your-secret-key';

  public static function createJWT($userId, $email)
  {
    $payload = [
      'iss' => 'your-domain.com',
      'sub' => $userId,
      'email' => $email,
      'iat' => time(),
      'exp' => time() + 3600 // 1 hora
    ];
    return FirebaseJWT::encode($payload, self::$secretKey);
  }

  public static function validateJWT($token)
  {
    return FirebaseJWT::decode($token, self::$secretKey, ['HS256']);
  }
}
