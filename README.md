# SongApp

SongApp is a web platform for creating songs and playlists. 

## Table of Contents

- [Architecture](#architecture)
- [Dependencies](#dependencies)
- [Installation](#installation)
- [Usage](#usage)

## Architecture

This website was built with plain html/js/css on the frontend, and php/postgresql for the backend.

## Dependencies
 
In order to run the platform, you need a webserver with PHP support, and a postgreSQL database

The easiest is to use WAMP on Windows or MAMP on MacOS, which sets up everything required for this platform to run. Just set the Apache's root folder to this `./public` folder.

## Installation

Add php to path

On MacOS:
```
nano ~/.bashrc
export PATH=/Applications/MAMP/bin/php/php8.2.0/bin:$PATH
```

### Install dependencies

Install composer in the project
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=bin
php -r "unlink('composer-setup.php');"
```

Install PHP dependencies
```
php bin/composer.phar install
php bin/composer.phar dump-autoload
```

When there is a change in the namespaces, re-run dump-autoload

### Setup variables

Copy `.env.example` to `.env`, then edit corresponding variables to match your database configuration

### Setup database

Execute the initial SQL setup queries, present in the `db.sql` file.

You can use your favorite GUI (pgAdmin) or a command line:
````
psql -U <username> -d <database_name> -f db.sql
``````