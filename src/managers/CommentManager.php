<?php

namespace App\Managers;

use PDO;
use Lib\AbstractManager;

class CommentManager extends AbstractManager {
  public function __construct() {
    $fieldTypes = [
      'content' => PDO::PARAM_STR
    ];
    parent::__construct('comments', $fieldTypes);
  }

  public function getCommentsForSong(string $songId, int $limit): array {
    return $this->getItemsRelatedTo('song_id', $songId, $limit);
  }
}


?>