# Barangay Health Information System

This project is created using [Laravel Framework](https://laravel.com/). This is a migration of the existing capstone Barangay Health Information System.

## Downloading

Follow the instructions below on how to download the project and get started.

### Clone the repo.

Download the project by cloning the repo or download the zip file.

```bash
git clone https://github.com/Jovi9/rep-bhis.git
```

```bash
cd rep-bhis
```

After downloading, go inside the directory and run the following commands.

### Install packages and dependencies.

```bash
composer install
```

```bash
npm install && npm run build
```

### Configure the project

Copy the env example to create the env file and generate the app key.

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

Configure the env file database connection and mail host, then run the following commands to create and seed the database.

```bash
php artisan migrate && php artisan db:seed
```

Create public storage link.

```bash
php artisan storage:link
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
