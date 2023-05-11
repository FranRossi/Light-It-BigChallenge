<p align="center"><a href="https://lightit.io" target="_blank"><img src="https://lightit.io/images/Logo_purple.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

We help digital health startups, clinics, and medtech companies ideate, design, and develop custom web & mobile applications that transform the future of healthcare.

## Install

Requirements:

- Php >= 8.1.0 & Composer
- Docker
- `brew install php@8.1 composer` Mac OS X with brew
- `apt-get install php8.1` Ubuntu with apt-get (use sudo if is necessary)

### Backend Installation

1. Clone GitHub repo for this project locally:

   ```
   git clone git@github.com:FranRossi/Light-It-BigChallenge.git
   ```

2. cd into your project and create a copy of your .env file

   ```
   cd Light-It-BigChallange
   cp .env.example .env
   ```

3. After that you can use laravel sail for running your project with docker.

   ```
   ./vendor/bin/sail up -d
   ```

   See more detail below.

4. When the app is running, to get into the bash container (`sail bash`) you can use the following commands:

   ```
   docker exec -it light-it-bigchallenge-laravel.test-1 /bin/bash
   composer install
   ```

### Hooks

You must activate the hooks in your local git repository. To do so, just run the following command.

```
vendor/bin/captainhook install
```

Executing this will create the hook script located in your .git/hooks directory, for each hook you choose to install while running the command. So now every time git triggers a hook, CaptainHook gets executed.

If you don't have PHP installed locally or you have installed a different version, you can use Docker to execute CaptainHook. To do so you must install the hooks a bit differently.

```
vendor/bin/captainhook install --run-mode=docker --run-exec="docker exec CONTAINER_NAME"
```

You can choose your preferred docker command e.g.:

```
docker exec MY_CONTAINER_NAME
docker run --rm -v $(pwd):/var/www/html MY_IMAGE_NAME
docker-compose -f docker/docker-compose.yml run --rm -T MY_SERVICE_NAME
```

If you want to know more you can see de documentation in the official page https://captainhookphp.github.io/captainhook/

## Running

We use Laravel Sail, is a light-weight command-line interface for interacting with Laravel's default Docker development environment. Sail provides a great starting point for building a Laravel application without requiring prior Docker experience.

### Configuring A Bash Alias

By default, Sail commands are invoked using the `vendor/bin/sail` script that is included with all new Laravel applications:

However, instead of repeatedly typing vendor/bin/sail to execute Sail commands, you may wish to configure a Bash alias that allows you to execute Sail's commands more easily:

`alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'`

### Starting & Stopping Sail

`sail up`

To start all the Docker containers in the background, you may start Sail in "detached" mode:

`sail up -d`

To stop all of the containers, you may simply press Control + C to stop the container's execution. Or, if the containers are running in the background, you may use the stop command:

`sail stop`

### Executing Commands

```bash
# Running Artisan commands on docker...
php artisan queue:work

# Executing PHP Commands
php script.php

# Executing Composer Commands
composer require laravel/sanctum

# Running Tests
php artisan test

```

For more info <https://laravel.com/docs/9.x/sail>

## Php Standards

Run: `composer fixer` and execute php cs, php cs fixer, php stan and rector.

Read <https://lightit.slite.com/app/docs/rd0tnuQ5w>

## Testing

To run all test you can use:
`composer test`

## HTTP Codes references

The next list contains the HTTP codes returned by the API and the meaning in the present context:

- HTTP 200 Ok: the request has been processed successfully.
- HTTP 201 Created: the resource has been created. It's associated with a POST Request.
- HTTP 204 No Content: the request has been processed successfully but does not need to return an entity-body.
- HTTP 400 Bad Request: the request could not been processed by the API. You should review the data sent to.
- HTTP 401 Unauthorized: When the request was performed to the login endpoint, means that credentials are not matching with any. When the request was performed to another endpoint means that the token it's not valid anymore due TTL expiration.
- HTTP 403 Forbidden: the credentials provided with the request has not the necessary permission to be processed.
- HTTP 404 Not Found: the endpoint requested does not exist in the API.
- HTTP 422: the payload sent to the API did not pass the validation process.
- HTTP 500: an unknown error was triggered during the process.

Please refer to <https://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html> for reference

## hosts File

- 127.0.0.1

## System Requirements

- php: 8.1.x
- php ini configurations:
  - `upload_max_filesize = 50M`
  - `post_max_size = 50M`
