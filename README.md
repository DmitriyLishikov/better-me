## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**

## Software requirements

-   PHP >= 8.0.2

-   MySQL 5.7.\*

-   NPM >= v16.8.0 

### 1. Clone project from git

```bash
git clone git@github.com:DmitriyLishikov/better-me.git
```

### 2. Install composer dependencies

```bash
 composer install
```

### 3. Install JS dependencies

```bash
npm install

npm run build
```

### 4. Set up enviroment variables

1. Copy `.env.example` file to `.env`.
2. Fill `.env` file keys with your own values

### 5. Key generate

```bash
php artisan key:generate
```

### 6. Migrate

```bash
php artisan migrate
```

### 7. Start server

```bash
php artisan serve
```
