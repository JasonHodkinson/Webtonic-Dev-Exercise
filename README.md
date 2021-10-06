## Requirements
1. PHP 7.3 and above, or PHP 8 and above.
2. [Composer](https://getcomposer.org/), a dependency manager for PHP.
3. [Node.js](https://nodejs.org/en/download/) including npm.

## Dev Environment
Feel free to use any development environment of your choice but the project was built with [Docker](https://www.docker.com/products/docker-desktop) and [Laravel Sail](https://laravel.com/docs/8.x/sail) in mind.

### Getting Started With Docker:
- Docker on [Mac](https://laravel.com/docs/8.x/installation#getting-started-on-macos)
- Docker on [Windows](https://laravel.com/docs/8.x/installation#getting-started-on-windows)
- Docker on [Linux](https://laravel.com/docs/8.x/installation#getting-started-on-linux)

### Using Laravel Sail
- Sail commands are executed from `./vendor/bin/sail`.
- You can configure a Bash Alias to avoid repeatedly typing this out: `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'`
- When running PHP, Artisan, Composer and Node / NPM commands you can execute the commands by adding `sail` to the front.
```
# Running Artisan commands locally...
php artisan queue:work

# Running Artisan commands within Laravel Sail...
sail artisan queue:work
```

### Setting Up
1. Run `composer install && npm install` in the root of the project.
2. Copy the `.env.example` and rename it to `.env`.
3. Run `php artisan key:generate` and make sure the key gets added into the `.env` where it says `APP_KEY=`.
4. Setup your remaining `env` variables such as your database details.
5. Run `php artisan migrate --seed`. Login details will be provided to you in the console.
6. If you are using sail, run `sail up` to start your Docker containers. If you are using your own dev enviornment you can run `php artisan serve`.

## Login Details

The login details of an admin user and a regular user will be provided to you when you run the `DatabaseSeeder.php` wither with `php artisan migrate --seed` or `php artisan db:seed`. The permissions are as follows:

<ins>Admin</ins>
- Can view all grades
- Can import grades
- Can delete grades
- Can view courses
- Can create courses
- Can update courses (if they are the original creator)
- Can delete courses
- Can view students
- Can create students
- Can update students (if they are the original creator)
- Can delete students

<br>

<ins>Regular User</ins>
- Can view all grades
- Can view courses

## CSV Import File

The default .csv file that was included in the Dev Web Exercise document can be found at `/storage/framework/testing/grades.csv` and can be used to run the import.