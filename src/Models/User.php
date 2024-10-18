<?php

namespace App\Models;

use App\Database;
use PDO;
use PDOException;

class User
{
  private $db;

  public function __construct()
  {
    $this->db = (new Database())->getConnection();
  }

  public function createUser($name, $email, $password)
  {
    try {
      $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $password);
      $stmt->execute();

      // Devolver true si el registro fue exitoso
      return true;
    } catch (PDOException $e) {
      // Verificar si es un error de duplicado (viola la restricción UNIQUE)
      if ($e->getCode() === '23000') {
        // Retornar un mensaje indicando que el correo ya existe
        return [
          'error' => true,
          'message' => 'El correo ya esta registrado.',
          'status' => 409 // Código HTTP 409 para conflicto
        ];
      }

      // Enviar cualquier otro error de base de datos
      return [
        'error' => true,
        'message' => 'Error al registrar el usuario.',
        'status' => 500 // Código HTTP 500 para error interno
      ];
    }
  }

  public function findUserByEmail($email)
  {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
