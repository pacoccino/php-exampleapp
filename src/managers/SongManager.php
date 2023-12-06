<?php

namespace App\Managers;

use PDO;
use DateTime;
use Lib\AbstractManager;

class SongManager extends AbstractManager
{
  const TABLE_NAME = 'songs';
  public function __construct()
  {
    parent::__construct();
  }

  public function getSongs(int $limit): array
  {
    $sql = "SELECT * FROM " . SongManager::TABLE_NAME . " LIMIT :limit";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query->execute();
    $items = $query->fetchAll();
    $query->closeCursor();
    return $items;
  }


  public function getSong(string $id): array
  {
    $sql = "SELECT * FROM " . SongManager::TABLE_NAME . " WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $item = $query->fetch();
    $query->closeCursor();
    return $item;
  }

  public function addSong(array $fields): string
  {
    $title = $fields['title'];
    $content = $fields['content'];
    $sql = "INSERT INTO " . SongManager::TABLE_NAME . " (title, content) VALUES (:title, :content) RETURNING id;";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $query->fetchColumn();
    return $lastInsertId;
  }

  public function deleteSong(string $id): void
  {
    $sql = "DELETE FROM " . SongManager::TABLE_NAME . " WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
  }

  public function editSong(string $id, array $fields): void
  {
    $title = $fields['title'];
    $content = $fields['content'];
    $updated_at = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
    $sql = "UPDATE " . SongManager::TABLE_NAME . " SET title = :title, content = :content WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->execute();
  }

}


?>