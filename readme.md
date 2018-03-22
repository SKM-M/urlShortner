# urlShortner

Quick Start-

Requirements-

1. Laravel 5.5 (and it's requirements such as PHP version >=7.0.0) 
2. Composer to install various packages (composer v2.0.2 or >2)  => https://getcomposer.org/download/

------------------------------------------------
Steps-

composer create-project laravel/laravel 

1. clone project => git clone https://github.com/Sheshkumar123/urlShortner.git
2. open CMD or powershell and go to that location 
3. run "composer install" to install all the project dependencies
4. run command "copy .env.example .env" , this will make local .env file
5. run "php artisan key:generate" to generate the application key.
6. Configure database 
    a. Open .env file and check db configs, namely 5 below. Ensure correct values for the configs

        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=laraveldb
        DB_USERNAME=root
        DB_PASSWORD=<replace this with the correct password>
    b. Create database/schema "laraveldb" in  mysql phpmyadmin
    c. Install database "php artisan migrate"

----------------------------------------------------------------------
7. run "php artisan db:seed" command to get all dummy data into table.

8. run "php artisan serve" command and a local server will start at 127.0.0.1:8000

---------------------------------
Default login credentials
---------------------------------
Email : admin@test.com
Password: admin@test
