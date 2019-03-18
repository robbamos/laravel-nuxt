# Laravel + Nuxt

This repo aims to remove the hassle of having to setup and configure 
authentication for your next Nuxt based WebApp.

The structure of this project enables easy and secure consumption of your Laravel powered API,
through a single


## Development Quick Start
For development, the frontend is configured to port 3000 by default, and assumes that
the laravel application is served on port 3001.

### Backend setup
Within the backend directory:

```
composer install
php artisan key:generate
php artisan migrate --seed
php artisan jwt:secret
php artisan serve --port=3001
```

### Frontend setup
Within the frontend directory:

```
npm install
npm run dev
```