<?php

namespace App\Controllers;

use Lib\AbstractController;
use App\Managers\ItemManager;

class ItemsController extends AbstractController
{
    public function execute()
    {
        $itemManager = new ItemManager();

        $items = $itemManager->getItems(10);
        $this->renderView('items', ['items' => $items]);

    }
}

?>