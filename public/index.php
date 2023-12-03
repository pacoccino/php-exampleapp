<?php

require __DIR__ . '/../vendor/autoload.php';

use Lib\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

new Router();

?>