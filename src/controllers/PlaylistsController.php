<?php

namespace App\Controllers;

use Lib\AbstractController;
use App\Managers\PlaylistManager;

class PlaylistsController extends AbstractController {
    public function execute() {
        $playlistManager = new PlaylistManager();

        $playlists = $playlistManager->getItems(10);
        $seo = ['title' => "Playlists", "description" => "list of playlists"];

        $this->renderView('playlists', ['playlists' => $playlists], $seo);

    }
}

?>