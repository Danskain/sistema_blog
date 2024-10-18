<?php

namespace App\Controllers;

use App\Services\AuthService;

class AuthController
{
  private $authService;

  public function __construct()
  {
    $this->authService = new AuthService();
  }

  public function register($request)
  {
    $name = $request['name'];
    $email = $request['email'];
    $password = $request['password'];

    $user = $this->authService->register($name, $email, $password);
    /* if ($user) {
      echo json_encode(['message' => 'Usuario registrado correctamente']);
      http_response_code(201); // Código 201: creado
    } else {
      echo json_encode(['message' => 'Error al registrar usuario']);
      http_response_code(500); // Código 500: error interno del servidor
    } */
    return json_encode($user);
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
