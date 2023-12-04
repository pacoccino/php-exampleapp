<?php

namespace App\Managers;

use Ramsey\Uuid\Uuid;
use PDO;
use DateTime;
use Lib\AbstractManager;

class CommentManager extends AbstractManager
{
  const TABLE_NAME = 'comments';
  public function __construct()
  {
    parent::__construct();
  }

  public function getComments(int $itemId, int $limit): array
  {
    $sql = "SELECT * FROM " . CommentManager::TABLE_NAME . " WHERE item_id = :item_id LIMIT :limit";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query->bindParam(':item_id', $itemId, PDO::PARAM_INT);
    $query->execute();
    $items = $query->fetchAll();
    $query->closeCursor();
    return $items;
  }

}


?>