<?php

namespace App\Controllers;

use Lib\AbstractController;
use App\Models\Song;
use App\Models\Comment;
use App\Managers\SongManager;
use App\Managers\CommentManager;

class SongController extends AbstractController {

    public function execute() {

        $songManager = new SongManager();
        $commentManager = new CommentManager();

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action'])) {
            if($_GET['action'] === 'create') {
                // Verification 
                if(!isset($_POST['title']) || !isset($_POST['content'])) {
                    $this->redirect('songs', ['action' => 'create-error']);
                } else {
                    $song = new Song(['title' => $_POST['title'], 'content' => $_POST['content']]);
                    $songId = $songManager->createItem($song);
                    $this->redirect('song', ['id' => $songId, 'action' => 'create-success']);
                }
            }
            if($_GET['action'] === 'comment') {
                // Verification 
                if(!isset($_POST['content']) || !isset($_GET['id'])) {
                    $this->redirect('songs', ['action' => 'comment-error']);
                } else {
                    $comment = new Comment(['song_id' => $_GET['id'], 'content' => $_POST['content']]);
                    $commentManager->createItem($comment);
                }
            }
        }


        if(!isset($_GET['id'])) {
            $this->redirect('songs');
        }
        $songId = $_GET['id'];
        $song = $songManager->getItem($songId);
        $comments = $commentManager->getCommentsForSong($songId, 10);

        $seo = ['title' => $song->title, "description" => $song->content];

        $this->renderView('song', ['songId' => $songId, 'song' => $song, 'comments' => $comments], $seo);
    }
}

?>