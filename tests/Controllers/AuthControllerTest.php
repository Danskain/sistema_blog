<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\AuthController;
use App\Models\User;

class AuthControllerTest extends TestCase
{
  private $authController;
  private $mockUserModel;

  protected function setUp(): void
  {
    // Crear un mock de la clase User para simular comportamiento de base de datos
    $this->mockUserModel = $this->createMock(User::class);
    $this->authController = new AuthController($this->mockUserModel);
  }

  public function testRegisterSuccess()
  {
    // Configurar el mock para devolver un valor cuando se llame a createUser
    $this->mockUserModel->method('createUser')
      ->willReturn(true);

    // Simular los datos de registro
    $data = [
      'name' => 'John Doe',
      'email' => 'john@example.com',
      'password' => 'password123'
    ];

    // Ejecutar el método register y capturar la salida
    $response = $this->authController->register($data);

    // Comprobar que la respuesta incluye "Usuario registrado correctamente"
    $this->assertStringContainsString('Usuario registrado correctamente', $response);
  }

  public function testRegisterEmailAlreadyExists()
  {
    // Configurar el mock para devolver un valor cuando el email ya existe
    $this->mockUserModel->method('findUserByEmail')
      ->willReturn(['email' => 'john@example.com']);

    // Simular los datos de registro
    $data = [
      'name' => 'John Doe',
      'email' => 'john@example.com',
      'password' => 'password123'
    ];

    // Ejecutar el método register y capturar la salida
    $response = $this->authController->register($data);

    // Comprobar que la respuesta incluye "El correo ya está registrado"
    $this->assertStringContainsString('El correo ya está registrado', $response);
  }
}
