<?php

namespace App\Controllers;

use Lib\Manager;
use Lib\AbstractController;
use App\Models\Playlist;

class PlaylistsController extends AbstractController
{
    public function execute()
    {
        $playlistManager = Manager::getClassManager(Playlist::class);

        $playlists = $playlistManager->getItems(10);
        $seo = ['title' => "Playlists", "description" => "list of playlists"];

        $this->renderView('playlists', ['playlists' => $playlists], $seo);

    }
}

?>