<?php

namespace App\Services;

use App\Models\User;
use App\Helpers\JWT;

class AuthService
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new User();
  }

  public function register($name, $email, $password)
  {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    return $this->userModel->createUser($name, $email, $hashedPassword);
  }

  public function login($email, $password)
  {
    $user = $this->userModel->findUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
      return JWT::createJWT($user['id'], $user['email']);
    }

    return null;
  }
}
