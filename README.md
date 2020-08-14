# Calendar Event API

## Introduction

This project is a simple API where you can add calendar events which uses Lumen, a laravel framework for microservices and API

## Server Requirements

1. [MySQL >= 15.1](https://www.mysql.com/)
2. [PHP >= 7.2](https://www.php.net/)

## Install

To install, download or clone this repository.

Run the following command in command line within the cloned project to install all vendor

	composer install

Create .env file and copy and fill up the details base on the .env.example file

Run the following command in command line within the cloned project to create the necessary tables to your project

	php artisan migrate

Finally, run the following command in command line within the cloned project to run the API

	php -S localhost:8000 -t public

## Reference

1. [Lumen](https://lumen.laravel.com/)