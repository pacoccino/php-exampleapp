<?php

namespace App\Managers;

use PDO;
use Lib\AbstractManager;

class PlaylistManager extends AbstractManager {
  public function __construct() {
    parent::__construct('playlists');
  }

  public function getPlaylists(int $limit): array {
    $sql = "SELECT * FROM ".$this->tableName." LIMIT :limit";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query->execute();
    $items = $query->fetchAll();
    $query->closeCursor();
    return $items;
  }

  public function getPlaylist(string $id): array {
    $sql = "SELECT * FROM ".$this->tableName." WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $item = $query->fetch();
    $query->closeCursor();
    return $item;
  }

  public function addPlaylist(array $fields): string {
    $title = $fields['title'];
    $sql = "INSERT INTO ".$this->tableName." (title) VALUES (:title) RETURNING id;";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $query->fetchColumn();
    return $lastInsertId;
  }

  public function deletePlaylist(string $id): void {
    $sql = "DELETE FROM ".$this->tableName." WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
  }

  public function editPlaylist(string $id, array $fields): void {
    $title = $fields['title'];
    $sql = "UPDATE ".$this->tableName." SET title = :title WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->execute();
  }

}


?>