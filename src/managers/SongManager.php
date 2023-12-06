<?php

namespace App\Managers;

use PDO;
use Lib\AbstractManager;

class SongManager extends AbstractManager {
  public function __construct() {
    parent::__construct('songs');
  }

  public function getSong(string $id): array {
    $sql = "SELECT * FROM ".$this->tableName." WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $item = $query->fetch();
    $query->closeCursor();
    return $item;
  }

  public function addItem(array $fields): string {
    $title = $fields['title'];
    $content = $fields['content'];
    $sql = "INSERT INTO ".$this->tableName." (title, content) VALUES (:title, :content) RETURNING id;";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $query->fetchColumn();
    return $lastInsertId;
  }

  public function deleteSong(string $id): void {
    $sql = "DELETE FROM ".$this->tableName." WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
  }

  public function editSong(string $id, array $fields): void {
    $title = $fields['title'];
    $content = $fields['content'];
    $sql = "UPDATE ".$this->tableName." SET title = :title, content = :content WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->execute();
  }

}


?>