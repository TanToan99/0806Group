How to install and run project:

```sh
composer install
cp .env.example .env
php artisan key:generate
php artisan db:seed
php artisan storage:link
php artisan love:reaction-type-add --default
```