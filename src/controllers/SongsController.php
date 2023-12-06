<?php

namespace App\Controllers;

use Lib\AbstractController;
use App\Managers\SongManager;

class SongsController extends AbstractController {
    public function execute() {
        $songManager = new SongManager();

        $songs = $songManager->getItems(10);
        $seo = ['title' => "songs", "description" => "list of songs"];

        $this->renderView('songs', ['songs' => $songs], $seo);

    }
}

?>