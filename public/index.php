<?php

require __DIR__.'/../vendor/autoload.php';

use Lib\Router;

$_DOTENV = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$_DOTENV->load();

new Router();

?>