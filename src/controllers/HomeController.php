<?php

namespace App\Controllers;

use Lib\AbstractController;
use App\Managers\ItemManager;

class HomeController extends AbstractController
{
    public function execute()
    {
        $itemManager = new ItemManager();

        $items = $itemManager->getItems(10);
        $this->renderView('home', ['items' => $items]);

    }
}

?>