<?php

namespace App\Managers;

use PDO;
use DateTime;
use Lib\AbstractManager;

class PlaylistManager extends AbstractManager
{
  const TABLE_NAME = 'playlists';
  public function __construct()
  {
    parent::__construct();
  }

  public function getPlaylists(int $limit): array
  {
    $sql = "SELECT * FROM " . PlaylistManager::TABLE_NAME . " LIMIT :limit";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query->execute();
    $items = $query->fetchAll();
    $query->closeCursor();
    return $items;
  }

  public function getPlaylist(string $id): array
  {
    $sql = "SELECT * FROM " . PlaylistManager::TABLE_NAME . " WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $item = $query->fetch();
    $query->closeCursor();
    return $item;
  }

  public function addPlaylist(array $fields): string
  {
    $title = $fields['title'];
    $sql = "INSERT INTO " . PlaylistManager::TABLE_NAME . " (title) VALUES (:title) RETURNING id;";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $query->fetchColumn();
    return $lastInsertId;
  }

  public function deletePlaylist(string $id): void
  {
    $sql = "DELETE FROM " . PlaylistManager::TABLE_NAME . " WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
  }

  public function editPlaylist(string $id, array $fields): void
  {
    $title = $fields['title'];
    $updated_at = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
    $sql = "UPDATE " . PlaylistManager::TABLE_NAME . " SET title = :title WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->execute();
  }

}


?>