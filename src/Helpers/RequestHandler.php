<?php

namespace App\Helpers;

class RequestHandler
{
  // Método para obtener datos de POST
  public static function getPostData()
  {
    // Captura los datos enviados por POST como JSON
    $input = file_get_contents('php://input');
    return json_decode($input, true);
  }

  // Método para obtener parámetros de GET
  public static function getGetData()
  {
    return $_GET;
  }

  // Método para obtener una URI limpia sin partes innecesarias
  public static function getCleanUri()
  {
    // Quitar el prefijo que incluye /index.php para obtener solo la URI
    $requestUri = str_replace('/PHP/Blog_Sistema/index.php', '', $_SERVER['REQUEST_URI']);
    return $requestUri;
  }

  // Método para obtener el método HTTP (GET, POST, etc.)
  public static function getRequestMethod()
  {
    return $_SERVER['REQUEST_METHOD'];
  }
}
