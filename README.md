# Nuxt + Vuetify + Laravel 

## Development Quick Start


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

```
npm i
npm run dev
```