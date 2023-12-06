<?php

const AVAILABLE_ROUTES = [
    'home' => App\Controllers\HomeController::class,
    'songs' => App\Controllers\SongsController::class,
    'song' => App\Controllers\SongController::class,
    'playlists' => App\Controllers\PlaylistsController::class,
    '404' => App\Controllers\NotFoundController::class,
];

const DEFAULT_ROUTE = AVAILABLE_ROUTES['home'];
const UNKNOWN_ROUTE = AVAILABLE_ROUTES['404'];

?>