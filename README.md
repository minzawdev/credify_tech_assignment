# credify_tech_assignment
Accredify Technical Assignment for Laravel Developer

Server Deploy Required

PHP              >= 8.1
Laravel Version     10


Project Setup to Server 

Todo CheckList on server

1. Git Clone "https://github.com/minzawdev/credify_tech_assignment.git"
2. create .env file which can copy from .env.example

    setup .env for database connection

    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=credify_db
    DB_USERNAME=
    DB_PASSWORD=

3. composer install --optimize-autoloader --no-dev
4. php artisan migrate
5. php artisan passport:install
6. import postman json file from email for API request and response