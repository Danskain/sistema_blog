<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
  private $postModel;

  public function __construct()
  {
    $this->postModel = new Post();
  }

  public function createPost($title, $content, $userId, $categoryId)
  {
    return $this->postModel->createPost($title, $content, $userId, $categoryId);
  }

  public function listPostsByCategory($categoryId)
  {
    return $this->postModel->listPostsByCategory($categoryId);
  }
}
