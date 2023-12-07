<?php

namespace App\Managers;

use PDO;
use Lib\AbstractManager;
use App\Models\Comment;

class CommentManager extends AbstractManager {
  public function __construct() {
    $fieldTypes = [
      'content' => PDO::PARAM_STR,
      'song_id' => PDO::PARAM_STR
    ];
    parent::__construct('comments', $fieldTypes, Comment::class);
  }

  public function getCommentsForSong(string $songId, int $limit): array {
    return $this->getItemsRelatedTo('song_id', $songId, $limit);
  }
}


?>