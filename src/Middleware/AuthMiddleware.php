<?php

namespace App\Middleware;

use App\Helpers\JWT;
use App\Helpers\ResponseHandler;

class AuthMiddleware
{
  public static function handle()
  {
    try {
      $headers = getallheaders();

      // Verificar si hay una cabecera Authorization
      if (!isset($headers['Authorization'])) {
        ResponseHandler::sendError('No se proporcionó un token de autorización', 401);
      }

      // Obtener el token de la cabecera
      $token = str_replace('Bearer ', '', $headers['Authorization']);

      // Validar el token
      $user = JWT::validateJWT($token);

      return $user;
    } catch (\Exception $e) {
      // En caso de error con el JWT
      ResponseHandler::sendError('Autenticación fallida: ' . $e->getMessage(), 401);
    }
  }
}
