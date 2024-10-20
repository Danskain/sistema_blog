Blog Sistema - Instalación y Configuración

Este es un sistema básico de gestión de un blog que utiliza PHP con una arquitectura MVC simple, MySQL como base de datos, y la biblioteca vlucas/phpdotenv para manejar variables de entorno y la biblioteca firebase/php-jwt para la seguridad.

Requisitos Previos
Antes de comenzar, asegúrate de tener instalados los siguientes componentes:

PHP 7.4+
Composer (para manejar dependencias de PHP)
XAMPP o WAMP (para el servidor local y MySQL)
MySQL (para la base de datos)
Pasos de Instalación

1. Clonar el Repositorio
   Clona este repositorio en tu servidor local (por ejemplo, en la carpeta htdocs de XAMPP):

bash
Copiar código
**git clone https://github.com/tu_usuario/blog_sistema.git**

2. Instalar Dependencias
   Navega a la carpeta del proyecto y ejecuta el siguiente comando para instalar las dependencias usando Composer:

bash
Copiar código
cd blog_sistema
**composer install**

3. Configurar el Archivo .env
   Crea un archivo .env en la raíz del proyecto (en la misma carpeta que composer.json). Este archivo almacenará las variables de entorno necesarias para conectar con tu base de datos y el codigo de sejuridad JWT. Utiliza el siguiente formato:

bash
Copiar código
**DB_HOST=localhost**
**DB_NAME=nombre_de_tu_base_de_datos**
**DB_USER=root**
**DB_PASS=tu_contraseña**
**SECRETKEY="WWWW.DANSKAIN.COM"**
**URL_LOCALHOST="/PHP/Blog_Sistema/index.php"**
Asegúrate de reemplazar los valores con los de tu configuración local de MySQL.

4. Crear la Base de Datos
   Crea una base de datos MySQL con el nombre que especificaste en el archivo .env. Luego, ejecuta las migraciones SQL necesarias para crear las tablas del sistema:

sql
Copiar código
CREATE DATABASE nombre_de_tu_base_de_datos;
USE nombre_de_tu_base_de_datos;

-- Añade aquí las consultas SQL para crear tus tablas, por ejemplo:

- Crear la base de datos 'blog' --
  CREATE DATABASE IF NOT EXISTS blog;

-- Usar la base de datos 'blog'
USE blog;

-- Crear la tabla 'categories' --
CREATE TABLE IF NOT EXISTS categories (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL
);

-- Crear la tabla 'users' --
CREATE TABLE IF NOT EXISTS users (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear la tabla 'posts' --
CREATE TABLE IF NOT EXISTS posts (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
content TEXT NOT NULL,
userid INT(11) NOT NULL,
categoryid INT(11),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (userid) REFERENCES users(id) ON DELETE CASCADE,
FOREIGN KEY (categoryid) REFERENCES categories(id) ON DELETE SET NULL
);

5. Configurar el Servidor Local
   Coloca el proyecto dentro de la carpeta htdocs (o equivalente para tu servidor local). Asegúrate de que Apache esté corriendo en XAMPP o WAMP.

6. Verificar el Archivo index.php
   Tu archivo index.php debe estar en la raiz del proyecto :

php
**Copiar código**

<?php

require '/vendor/autoload.php';

// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require './src/Routes.php';

7. Probar el Proyecto
Abre tu navegador web y navega a la siguiente URL:

bash
Copiar código
**http://localhost/PHP/Blog_Sistema/index.php**

8. Uso del Sistema
Registro de Usuarios
Para registrar un usuario, puedes enviar una solicitud POST a la siguiente URL:

Copiar código
POST /api/register
Con un cuerpo de solicitud JSON como el siguiente:

json
Copiar código
{
  "name": "Nombre del usuario",
  "email": "usuario@correo.com",
  "password": "contraseña_segura"
}

Login de Usuarios
Para iniciar sesión, envía una solicitud POST a la siguiente URL:

bash
Copiar código
POST /api/login
Con un cuerpo de solicitud JSON como el siguiente:

json
Copiar código
{
  "email": "usuario@correo.com",
  "password": "contraseña_segura"
}

Creación de Posts
Para crear un nuevo post (autenticado), usa el token de autenticación y envía una solicitud POST a:

bash
Copiar código
POST /api/posts
Con un cuerpo de solicitud JSON:

json
Copiar código
{
  "title": "Título del post",
  "content": "Contenido del post"
}

9. Migraciones SQL
Recuerda agregar tus migraciones SQL manualmente para mantener las tablas actualizadas en tu base de datos.

10. Errores Comunes
"Failed to open stream": Asegúrate de que las rutas de tus archivos son correctas y de que composer install ha generado el archivo vendor/autoload.php.
No se leen las variables de entorno: Verifica que el archivo .env esté en la ubicación correcta y que phpdotenv esté configurado correctamente en index.php.
Contribuir
Si deseas contribuir a este proyecto, por favor crea un Pull Request o abre un Issue en el repositorio de GitHub.

Licencia
Este proyecto está bajo la licencia MIT.
