<?php

namespace App\Managers;

use Ramsey\Uuid\Uuid;
use PDO;
use DateTime;
use Lib\AbstractManager;

class CommentManager extends AbstractManager
{
  public function __construct()
  {
    parent::__construct('comments');
  }

  public function getComments(string $itemId, int $limit): array
  {
    $sql = "SELECT * FROM " . $this->tableName . " WHERE song_id = :song_id LIMIT :limit";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query->bindParam(':song_id', $itemId, PDO::PARAM_STR);
    $query->execute();
    $items = $query->fetchAll();
    $query->closeCursor();
    return $items;
  }

}


?>