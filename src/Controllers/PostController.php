<?php

namespace App\Controllers;

use App\Services\PostService;

class PostController
{
  private $postService;

  public function __construct()
  {
    $this->postService = new PostService();
  }

  public function createPost($request)
  {
    $title = $request['title'];
    $content = $request['content'];
    $userId = $request['userId'];
    $categoryId = $request['categoryId'];

    $post = $this->postService->createPost($title, $content, $userId, $categoryId);
    return json_encode($post);
  }

  public function listPostsByCategory($categoryId)
  {
    $posts = $this->postService->listPostsByCategory($categoryId);
    return json_encode($posts);
  }
}
