<?php

namespace App\Models;

use App\Database;
use PDO;

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
      return $stmt->execute();
      //code...
    } catch (\Throwable $th) {
      http_response_code(500);
      return $th;
      //throw $th;
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
