<?php

namespace App\Controllers;

use Lib\AbstractController;
use App\Managers\SongManager;
use App\Managers\CommentManager;

class SongController extends AbstractController
{

    public function execute()
    {
        $songManager = new SongManager();
        $commentManager = new CommentManager();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] === 'create') {
            // Verification 
            if (!isset($_POST['title']) || !isset($_POST['content'])) {
                $this->redirect('songs', ['action' => 'create-post-error']);
            } else {
                $songId = $songManager->addSong(array('title' => $_POST['title'], 'content' => $_POST['content']));
                $this->redirect('song', ['id' => $songId, 'action' => 'create-post-success']);
            }
        }


        $songId = $_GET['id'];
        $song = $songManager->getSong($songId);
        $comments = $commentManager->getComments($songId, 10);

        $seo = ['title' => $song['title'], "description" => $song['content']];

        $this->renderView('song', ['song' => $song, 'comments' => $comments], $seo);
    }
}

?>