<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Helpers\ResponseHandler;

class AuthController
{
  private $authService;

  public function __construct()
  {
    $this->authService = new AuthService();
  }

  /* public function register($request)
  {
    $name = $request['name'];
    $email = $request['email'];
    $password = $request['password'];

    $user = $this->authService->register($name, $email, $password);

    return json_encode($user);
  } */

  public function register($data)
  {
    // Validar que los campos requeridos están presentes
    if (isset($data['name']) && isset($data['email']) && isset($data['password'])) {
      $name = $data['name'];
      $email = $data['email'];
      $password = $data['password'];

      // Intentar registrar el usuario
      $result = $this->authService->register($name, $email, $password);

      // Verificar si se encontró un error
      if (is_array($result) && isset($result['error']) && $result['error']) {
        ResponseHandler::sendError($result['message'], $result['status']);
      }

      // Respuesta exitosa
      ResponseHandler::sendSuccess('Usuario registrado correctamente', 201, [
        'name' => $name,
        'email' => $email
      ]);
    } else {
      // Respuesta de error si faltan campos requeridos
      ResponseHandler::sendError('Faltan datos requeridos', 400);
    }
  }

  public function login($request)
  {
    // Verificar que los campos requeridos están presentes
    if (isset($request['email']) && isset($request['password'])) {
      $email = $request['email'];
      $password = $request['password'];

      // Intentar iniciar sesión a través del servicio de autenticación
      $token = $this->authService->login($email, $password);

      // Si se genera un token, devolver una respuesta exitosa
      if ($token) {
        ResponseHandler::sendSuccess('Inicio de sesión exitoso', 200, [
          'token' => $token
        ]);
      } else {
        // Responder con un error si las credenciales no son válidas
        ResponseHandler::sendError('Credenciales inválidas', 401);
      }
    } else {
      // Responder con un error si faltan campos requeridos
      ResponseHandler::sendError('Faltan datos requeridos', 400);
    }
  }
}
