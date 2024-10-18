<?php

namespace App\Models;

use App\Database;
use PDO;

class Post
{
  private $db;

  public function __construct()
  {
    $this->db = (new Database())->getConnection();
  }

  public function createPost($title, $content, $userId, $categoryId)
  {
    $sql = "INSERT INTO posts (title, content, userid, categoryid) VALUES (:title, :content, :userId, :categoryId)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':categoryId', $categoryId);
    return $stmt->execute();
  }

  public function listPostsByCategory($categoryId)
  {
    $sql = "SELECT * FROM posts WHERE categoryid = :categoryId";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':categoryId', $categoryId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
