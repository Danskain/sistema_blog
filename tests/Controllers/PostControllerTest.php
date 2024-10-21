<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\PostController;
use App\Models\Post;
use App\Models\User;

class PostControllerTest extends TestCase
{
    private $postController;
    private $mockPostModel;

    protected function setUp(): void
    {
        // Crear un mock de la clase Post para simular el comportamiento de base de datos
        $this->mockPostModel = $this->createMock(Post::class);
        $this->postController = new PostController($this->mockPostModel);
    }

    public function testCreatePostSuccess()
    {
        // Configurar el mock para devolver un valor cuando se llame a createPost
        $this->mockPostModel->method('createPost')
            ->willReturn(true);

        // Simular los datos del post
        $data = [
            'title' => 'New Post',
            'content' => 'This is the content of the post.',
            'user_id' => 1
        ];

        // Ejecutar el método createPost y capturar la salida
        $response = $this->postController->createPost($data);

        // Comprobar que la respuesta incluye "Post creado correctamente"
        $this->assertStringContainsString('Post creado correctamente', $response);
    }

    public function testCreatePostValidationError()
    {
        // Simular los datos del post sin título
        $data = [
            'title' => '',
            'content' => 'This is the content of the post.',
            'user_id' => 1
        ];

        // Ejecutar el método createPost y capturar la salida
        $response = $this->postController->createPost($data);

        // Comprobar que la respuesta incluye "Faltan datos requeridos"
        $this->assertStringContainsString('Faltan datos requeridos', $response);
    }
}
