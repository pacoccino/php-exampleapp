<?php

namespace App\Controllers;

use Lib\AbstractController;
use App\Managers\ItemManager;

class ItemController extends AbstractController
{

    public function execute()
    {
        $itemManager = new ItemManager();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] === 'create') {
            // Verification 
            if (!isset($_POST['title']) || !isset($_POST['content'])) {
                $this->redirect('items', ['action' => 'create-post-error']);
            } else {
                $itemId = $itemManager->addItem(array('title' => $_POST['title'], 'content' => $_POST['content']));
                $this->redirect('item', ['id' => $itemId, 'action' => 'create-post-success']);
            }
        }


        $itemId = $_GET['id'];
        $item = $itemManager->getItem($itemId);

        $this->renderView('item', ['item' => $item]);

    }
}

?>