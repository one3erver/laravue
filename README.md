## Steps for install and using this project:

1. clone the project
2. run `composer install` in root directory
3. create `.env` file and copy everything's of `.env.example` file and paste in `.env`
4. run `php artisan key:generate` for generate app key
5. run `php artisan migrate --seed` to create tables in your database
6. for updates run `git pull` from main
7. then run `php artisan migrate:fresh --seed` to have last changes
8. for create admin user run `php artisan db:seed --class=AdminSeeder`
9. run `php artisan serve`
