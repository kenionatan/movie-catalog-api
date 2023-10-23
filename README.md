# Movie Catalog API

## Features
- Create, Edit, List and Delete movies.
- List and Register users

## Tecnologies

- PHP
- Laravel
- JQuery
- MySQL
- Docker

## Installation

##### Requirements
First of all you need to have docker and docker-compose and also git.
If you haven't installed it, here are some reference links:
- Here you will find the steps for installing Docker => https://docs.docker.com/get-docker/ 
- Here you will find the steps for installing Docker Docker Compose => https://docs.docker.com/compose/ 
- Here you will find the steps for installing Docker git => https://git-scm.com/book/en/v2/Getting-Started-Installing-Git

##### Clone the projeto
With git installed and in a directory of your choice, download the project:

```sh
git clone https://github.com/kenionatan/movie-catalog-api
```

##### Docker up
###### First check if the "db_data" folder is created in the root of the project, it will be used to persist MySQL data.

Then, with Docker-compose installed, run this command from the project root:

```sh
docker-compose build
```

```sh
docker-compose up -d
```

##### Access the container
With the container running, run this command at the root of the project:

```sh
docker exec -it app-movie bash
```
##### Configure .env

```sh
cp .env.example .env
```


```sh
php artisan key:generate
```

##### Install dependencies
execute:

```sh
composer install
```

##### Give permissions to the necessary folders
storage/logs and storage/framework, as we are in a testing environment we will give all permissions, just execute:

```sh
chmod -R 777 storage/logs storage/framework
```

##### Run the migrations

```sh
php artisan migrate:install
```

```sh
php artisan migrate
```

##### Generate swagger doc

```sh
php artisan l5-swagger:generate
```

> Alternatively, you can set L5_SWAGGER_GENERATE_ALWAYS to true in your .env file so that your documentation will automatically be generated. Make sure your settings in config/l5-swagger.php are complete.

##### Running tests

```sh
php artisan test
```