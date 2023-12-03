<?php

const AVAILABLE_ROUTES = [
    'home' => App\Controllers\HomeController::class,
    'item' => App\Controllers\ItemController::class,
    '404' => App\Controllers\NotFoundController::class,
];

const DEFAULT_ROUTE = AVAILABLE_ROUTES['home'];
const UNKNOWN_ROUTE = AVAILABLE_ROUTES['404'];

?>