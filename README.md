<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Este es un proyecto que tiene como objetivo demostrar algunas de las tecnologías que utilizo en mi trabajo.

### Getting started

Para crear un nuevo proyecto, clone el repositorio y ejecute el comando en la línea de comandos.

```

git clone git@github.com:webgrig/example-technology.git new-project

cd new-project

composer install

npm install

npm run prod

```
Luego debe copiar el contenido del archivo **.env.example** a un nuevo archivo **.env**

Para hacer esto, ingrese el comando

```

cp .env.example .env

```

Después de eso, necesita crear una base de datos de MySQL llamada "**laravel**", la codificación predeterminada es **"utf8mb4_unicode_ci"**.

La configuración de MySQL contiene un usuario **root** sin contraseña y una base de datos **laravel**. Puede anularlos en la sección correspondiente del archivo **.env** en la raíz del proyecto.

```

php artisan migrate --seed

```

Después de eso, puede iniciar el servidor de desarrollo

```
php artisan serve
```

En la barra de direcciones del navegador ingrese la dirección **http://127.0.0.1:8000**

```
login: superadmin@example.com

password: 11111111
```
