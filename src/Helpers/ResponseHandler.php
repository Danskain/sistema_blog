<?php

namespace App\Helpers;

class ResponseHandler
{
  // Método para enviar una respuesta con datos y código de estado HTTP
  public static function sendResponse($data = null, $message = 'Success', $statusCode = 200)
  {
    // Asegurar que el contenido es JSON
    header('Content-Type: application/json');

    // Configurar el código de estado HTTP
    http_response_code($statusCode);

    // Preparar el cuerpo de la respuesta
    $response = [
      'status' => $statusCode,
      'message' => $message,
    ];

    // Agregar datos solo si existen, de lo contrario poner null
    $response['data'] = $data ?? null;

    // Enviar respuesta como JSON
    echo json_encode($response);
    exit(); // Termina la ejecución del script
  }

  // Método para respuestas de error
  public static function sendError($message = 'Error', $statusCode = 500, $data = null)
  {
    self::sendResponse($data, $message, $statusCode);
  }

  // Método para respuestas de éxito sin datos
  public static function sendSuccess($message = 'Success', $statusCode = 200, $data = null)
  {
    self::sendResponse($data, $message, $statusCode);
  }
}
/* if ($user) {
      echo json_encode(['message' => 'Usuario registrado correctamente']);
      http_response_code(201); // Código 201: creado
    } else {
      echo json_encode(['message' => 'Error al registrar usuario']);
      http_response_code(500); // Código 500: error interno del servidor
    } */