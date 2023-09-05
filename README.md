# credify_tech_assignment
Accredify Technical Assignment for Laravel Developer

Server Deploy Required
PHP              >= 8.1
Laravel Version     10

Project Setup to Server & Todo CheckList on server

1. Git Clone "https://github.com/minzawdev/credify_tech_assignment.git"
2. create .env file and setup database  which can copy from .env.example
    DB_HOST=
    DB_PORT=3306
    DB_DATABASE=credify_db
    DB_USERNAME=
    DB_PASSWORD=
3. composer install --optimize-autoloader --no-dev
4. php artisan key:generate 
5. php artisan migrate
6. php artisan passport:install


For Checking APIs 

1. Import postman json file from email for API list
2. API List
   login
   register
   logout
   file Verify
 

   