<?php

namespace App\Controllers;

use Lib\Manager;
use Lib\AbstractController;
use App\Models\Song;
use App\Models\Comment;

class SongController extends AbstractController
{

    public function execute()
    {
        $songManager = Manager::getClassManager(Song::class);
        $commentManager = Manager::getClassManager(Comment::class);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action'])) {
            if ($_GET['action'] === 'create') {
                // Verification 
                if (!isset($_POST['title']) || !isset($_POST['content'])) {
                    $this->redirect('songs', ['action' => 'create-error']);
                } else {
                    $song = $songManager->createItem(['title' => $_POST['title'], 'content' => $_POST['content']]);
                    $this->redirect('song', ['id' => $song->id, 'action' => 'create-success']);
                }
            }
            if ($_GET['action'] === 'comment') {
                // Verification 
                if (!isset($_POST['content']) || !isset($_GET['id'])) {
                    $this->redirect('songs', ['action' => 'comment-error']);
                } else {
                    $commentManager->createItem(['song_id' => $_GET['id'], 'content' => $_POST['content']]);
                }
            }
        }


        if (!isset($_GET['id'])) {
            $this->redirect('songs');
        }
        $songId = $_GET['id'];
        $song = $songManager->getItem($songId);
        $comments = $song->getComments(10);

        $seo = ['title' => $song->title, "description" => $song->content];

        $this->renderView('song', ['songId' => $songId, 'song' => $song, 'comments' => $comments], $seo);
    }
}

?>