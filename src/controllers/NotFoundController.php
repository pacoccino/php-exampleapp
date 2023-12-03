<?php

namespace App\Controllers;

use Lib\AbstractController;

class NotFoundController extends AbstractController
{
    public function execute()
    {
        $this->renderView('404');

    }
}

?>