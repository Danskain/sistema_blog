<?php

namespace App\Helpers;

use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;

class JWT
{

  //private static $secretKey = ;

  public static function createJWT($userId, $email)
  {
    $payload = [
      'iss' => 'danska.com',
      'sub' => $userId,
      'email' => $email,
      'iat' => time(),
      'exp' => time() + 3600 // 1 hora
    ];
    return FirebaseJWT::encode($payload, $_ENV['SECRETKEY'], 'HS256');
  }

  public static function validateJWT($token)
  {
    try {
      // Se usa la clase Key para pasar la clave y el algoritmo
      return FirebaseJWT::decode($token, new Key($_ENV['SECRETKEY'], 'HS256'));
    } catch (\Exception $e) {
      // Puedes manejar el error aquí y lanzar una excepción personalizada o retornar un error
      throw new \Exception('Token no válido: ' . $e->getMessage());
    }
  }
}
