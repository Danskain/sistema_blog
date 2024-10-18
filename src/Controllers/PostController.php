<?php

namespace App\Controllers;

use App\Services\PostService;
use App\Helpers\ResponseHandler;

class PostController
{
  private $postService;

  public function __construct()
  {
    $this->postService = new PostService();
  }

  public function createPost($data)
  {
    if (isset($data['title']) && isset($data['content']) && isset($data['categoryid'])) {
      $title = $data['title'];
      $content = $data['content'];
      $categoryId = $data['categoryid'];
      $userId = $data['userid'];  // Asumiendo que el userId ya viene desde el middleware

      $post = $this->postService->createPost($title, $content, $categoryId, $userId);

      if ($post) {
        ResponseHandler::sendSuccess('Post creado exitosamente', 201, $post);
      } else {
        ResponseHandler::sendError('Error al crear el post', 500);
      }
    } else {
      ResponseHandler::sendError('Faltan datos requeridos', 400);
    }
  }

  public function listPostsByCategory($categoryId)
  {
    $posts = $this->postService->listPostsByCategory($categoryId);

    if ($posts) {
      ResponseHandler::sendSuccess('Posts encontrados', 200, $posts);
    } else {
      ResponseHandler::sendError('No se encontraron posts para esta categoría', 404);
    }
  }
}
