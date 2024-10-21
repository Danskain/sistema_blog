<?php

// Configuración de CORS para permitir solicitudes desde tu aplicación Angular
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require __DIR__ . '/vendor/autoload.php';
//require '../vendor/autoload.php';
// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  // Responder a la solicitud de preflight
  header("HTTP/1.1 200 OK");
  exit();
}

require './src/Routes.php';
