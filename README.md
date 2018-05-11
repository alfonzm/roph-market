# roph-market

## Setup

```
$ composer install
$ yarn
```

First time:

```
$ # setup .env
$ php artisan key:generate
$ php artisan migrate:install
$ php artisan migrate
```

## Development

```
$ npm run watch
$ php artisan serve
```

## Deploy

```
$ sudo su
$ php artisan migrate

$ npm install
$ composer install

$ npm run prod
$ php artisan cache:clear
```