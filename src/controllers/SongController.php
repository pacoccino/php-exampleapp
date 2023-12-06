<?php

namespace App\Controllers;

use Lib\AbstractController;
use App\Managers\SongManager;
use App\Managers\CommentManager;

class SongController extends AbstractController {

    public function execute() {
        $songManager = new SongManager();
        $commentManager = new CommentManager();

        $songId = $_GET['id'];

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action'])) {
            if($_GET['action'] === 'create') {
                // Verification 
                if(!isset($_POST['title']) || !isset($_POST['content'])) {
                    $this->redirect('songs', ['action' => 'create-error']);
                } else {
                    $songId = $songManager->addSong(array('title' => $_POST['title'], 'content' => $_POST['content']));
                    $this->redirect('song', ['id' => $songId, 'action' => 'create-success']);
                }
            }
            if($_GET['action'] === 'comment') {
                // Verification 
                if(!isset($_POST['content'])) {
                    $this->redirect('songs', ['action' => 'comment-error']);
                } else {
                    $commentManager->addComment(array('song_id' => $songId, 'content' => $_POST['content']));
                }
            }
        }


        $songId = $_GET['id'];
        $song = $songManager->getSong($songId);
        $comments = $commentManager->getComments($songId, 10);

        $seo = ['title' => $song['title'], "description" => $song['content']];

        $this->renderView('song', ['songId' => $songId, 'song' => $song, 'comments' => $comments], $seo);
    }
}

?>