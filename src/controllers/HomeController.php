<?php

namespace App\Controllers;

use Lib\AbstractController;

class HomeController extends AbstractController
{
    public function execute()
    {
        $this->renderView('home');
    }
}

?>