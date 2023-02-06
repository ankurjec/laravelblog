#Blog Project on Laravel

A Laravel application to manage blog with multiple user authentication.
Users are user, admin and public.
public user dont'have to login. They can view the blogs post appoved by admin which are posted by user.
To run this project follow the steps below
First Clone/download zip this repository.
In the project folder run 'npm install'.
run 'composer install'.
run 'composer update'.
run 'php artisan key:generate'.
create a database in phpmyadmin named 'blog_database'.
run command 'php artisan migrate'.
run command 'php artisan db:seed --class=DatabaseSeeder'.
run command 'php artisan serve'.
you can find the credentials for user and admin in the Seeder File.
Thats all. You Can see the blogs now.