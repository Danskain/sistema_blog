<?php

use App\Controllers\AuthController;
use App\Controllers\PostController;
use App\Middleware\AuthMiddleware;
use App\Helpers\RequestHandler;

$authController = new AuthController();
$postController = new PostController();

// Obtener la URI limpia
$cleanUri = RequestHandler::getCleanUri();
$requestMethod = RequestHandler::getRequestMethod();

// Ruta para registro de usuario
if ($requestMethod === 'POST' && $cleanUri === '/api/register') {
  $data = RequestHandler::getPostData();
  echo $authController->register($data);
}

// Ruta para login de usuario
if ($requestMethod === 'POST' && $cleanUri === '/api/login') {
  $data = RequestHandler::getPostData();
  echo $authController->login($data);
}

// Ruta para crear un nuevo post
if ($requestMethod === 'POST' && $cleanUri === '/api/posts') {
  $user = AuthMiddleware::handle(RequestHandler::getPostData());
  echo $postController->createPost(RequestHandler::getPostData());
}

// Ruta para listar posts por categoría
if ($requestMethod === 'GET' && preg_match('/\/api\/posts\/(\d+)/', $cleanUri, $matches)) {
  echo $postController->listPostsByCategory($matches[1]);
}
