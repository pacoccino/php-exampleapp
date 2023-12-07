<?php

namespace App\Managers;

use PDO;
use Lib\AbstractManager;

class PlaylistManager extends AbstractManager {
  public function __construct() {
    $fieldTypes = [
      'title' => PDO::PARAM_STR
    ];

    parent::__construct('playlists', $fieldTypes);
  }
}


?>