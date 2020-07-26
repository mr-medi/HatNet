# Sobre HatNet

HatNet es una plataforma de aprendizaje dedicada al hacking.
Es accesible y dispone de gran variedad de retos para poner a prueba
tus habilidades en distintas categorías.

## Tecnología

Para este proyecto se ha utilizado el framework **Laravel** con la
version 6.12.0.

## Requisitos

* **PHP** 7.3.11 (https://github.com/php/php-src)
* **mysql**  8.0.20 (https://github.com/mysql)
* **Laravel Framework** 6.12.0 (https://github.com/laravel/laravel)
* **Composer** 1.9.0 (https://github.com/composer/composer)
* **Apache** 2.4.41 (https://github.com/apache) o cualquier otro servidor web

## Funcionalidades

* **Gestión de usuarios**
* **Creación y uso de retos**
* **Creación de herramientas de programación**
* **Visualización de ranking**
* **Funcionalidad para dejar un comentario publico**

## Guía de instalación

Lo primero de todo sera clonar el repositorio.
```bash
#Clonamos el repositorio
git clone https://github.com/mr-medi/hatnet
```

Antes de proceder con la creación de las tablas necesitamos configurar unos parámetros
para la conexión con la base de datos, esto se encuentra en el fichero **'.env'** ubicado en la carpeta creada anteriormente. Los parámetros a modificar son:

* **DB_CONNECTION=mysql**
* **DB_HOST=127.0.0.1**
* **DB_PORT=3306**
* **DB_DATABASE=nombreDeLaBaseDeDatos**
* **DB_USERNAME=tuNombreDeUsuario**
* **DB_PASSWORD=tuContraseña**

Una vez configurados los parámetros anteriores necesitamos crear una base de datos con el nombre especificado en **'DB_DATABASE'** y ya
estariamos listos para crear las tablas y subir datos de prueba.

```bash
#Vamos a la carpeta creada anteriormente
cd hatnet
#Instalamos las dependencias de composer
composer install
#Creamos las tablas de la base de datos
php artisan migrate
#Subimos los datos de prueba
php artisan db:seed
```

Por último, solo nos quedaría ir a nuestro navegador y poner la ruta correspondiente para acceder al proyecto.
