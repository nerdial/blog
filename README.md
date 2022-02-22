## Features
1. Single static post (calls the api to get that)
2. List of all comments for that single post order by latest
3. User can create comments
4. Nested comment up to 3 level supported
5. Vue JS Front-end => /resources/js/components
6. Unit test for the apis



## Clone the project and run composer

```console
composer install
```

## Copy the .env.example into .env

```console
cp .env.example .env
```

## Then you need create an application key for laravel

```console
php artisan key:generate
```


## Run migrations

```console
php artisan migrate
```

## Fake comments

```console
php artisan db:seed
```


## This project has unit tests

```console
php artisan test
```


## Run your webserver by calling :

```console
php artisan serve
```
