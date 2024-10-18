<?php

use App\Controllers\AuthController;
use App\Controllers\PostController;
use App\Middleware\AuthMiddleware;

$authController = new AuthController();
$postController = new PostController();

//echo json_encode(['token' => $_SERVER['REQUEST_URI']]);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/PHP/Blog_Sistema/public/index.php/api/register') {
  //echo json_encode(['token' => $_POST]);
  $input = file_get_contents('php://input');
  $data = json_decode($input, true);
  echo $authController->register($data);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/PHP/Blog_Sistema/public/index.php/api/login') {
  $input = file_get_contents('php://input');
  $data = json_decode($input, true);
  echo $authController->login($data);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/posts') {
  $user = AuthMiddleware::handle($_POST);
  echo $postController->createPost($_POST);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && preg_match('/\/api\/posts\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
  echo $postController->listPostsByCategory($matches[1]);
}
