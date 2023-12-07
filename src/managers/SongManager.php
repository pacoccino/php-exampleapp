<?php

namespace App\Managers;

use PDO;
use Lib\AbstractManager;

class SongManager extends AbstractManager {
  public function __construct() {
    $fieldTypes = [
      'title' => PDO::PARAM_STR,
      'content' => PDO::PARAM_STR,
    ];

    parent::__construct('songs', $fieldTypes);

  }
}


?>