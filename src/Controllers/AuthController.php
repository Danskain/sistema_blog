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
    $email = $request['email'];
    $password = $request['password'];

    $token = $this->authService->login($email, $password);

    if ($token) {
      return json_encode(['token' => $token]);
    }

    return json_encode(['error' => 'Invalid credentials']);
  }
}
