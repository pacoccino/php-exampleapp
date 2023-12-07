<?php

namespace App\Controllers;

use Lib\Manager;
use Lib\AbstractController;
use App\Models\Song;

class SongsController extends AbstractController
{
    public function execute()
    {
        $songManager = Manager::getClassManager(Song::class);

        $songs = $songManager->getItems(10);
        $seo = ['title' => "songs", "description" => "list of songs"];

        $this->renderView('songs', ['songs' => $songs], $seo);

    }
}

?>