<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### Getting started

Para crear un nuevo proyecto, clone el repositorio y ejecute el comando en la línea de comandos.

git clone git@github.com:webgrig/test-trabajo.git new-project

cd new-project

composer install

npm install

después de eso, en mayo de SQL, debe crear una base de datos llamada testo_de_jorge, la codificación predeterminada es utf8mb4_unicode_ci

también es necesario crear un usuario de laravel con todos los derechos para esta base
Debes darle a este usuario una contraseña laravelpass

Luego debe copiar el contenido del archivo .env.example a un nuevo archivo .env

para hacer esto, ingrese el comando

cp .env.example .env

php artisan migrate

después de eso, puede iniciar el servidor de desarrollo

en la barra de direcciones del navegador ingrese la dirección http://127.0.0.1:8000

login: superadmin@example.com
password: 111111
