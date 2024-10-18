<?php

require '../vendor/autoload.php';
// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');

$dotenv->load();

require '../src/Routes.php';
