<?php

namespace App;

use PDO;
use PDOException;

class Database
{
  private $host;
  private $db;
  private $user;
  private $pass;
  private $charset = 'utf8mb4';
  private $pdo;
  private $error;

  public function __construct()
  {

    $this->host = $_ENV['DB_HOST'];
    $this->db = $_ENV['DB_NAME'];
    $this->user = $_ENV['DB_USER'];
    $this->pass = $_ENV['DB_PASS'];

    $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
      $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  public function getConnection()
  {
    return $this->pdo;
  }
}
