<?php

namespace App\Managers;

use Ramsey\Uuid\Uuid;
use PDO;
use DateTime;
use Lib\AbstractManager;

class ItemManager extends AbstractManager
{
  const TABLE_NAME = 'items';
  public function __construct()
  {
    parent::__construct();
  }

  // ===== LECTURE ===== //

  // Retourne la liste des articles
  public function getItems(int $limit): array
  {
    $sql = "SELECT * FROM " . ItemManager::TABLE_NAME . " LIMIT :limit";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query->execute();
    $items = $query->fetchAll();
    $query->closeCursor();
    return $items;
  }


  // Retourne un article spécifique
  public function getItem(int $id): array
  {
    $sql = "SELECT * FROM " . ItemManager::TABLE_NAME . " WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $item = $query->fetch();
    $query->closeCursor();
    return $item;
  }

  // ===== ECRITURE ===== //

  // Ajoute un nouvel article en BDD
  public function addItem(array $fields): int
  {
    $uuid = Uuid::uuid4()->toString();
    $title = $fields['title'];
    $content = $fields['content'];
    $created_at = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
    $sql = "INSERT INTO " . ItemManager::TABLE_NAME . " (title, content, uuid, created_at) VALUES (:title, :content, :uuid, :created_at)";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':uuid', $uuid, PDO::PARAM_STR);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->bindParam(':created_at', $created_at, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $this->pdo->lastInsertId();
    return $lastInsertId;
  }

  // Supprime un article en BDD
  public function deleteItem(int $id): void
  {
    $sql = "DELETE FROM " . ItemManager::TABLE_NAME . " WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
  }

  // Edite un article en BDD
  public function editArticle(int $id, array $fields): void
  {
    $title = $fields['title'];
    $content = $fields['content'];
    $updated_at = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
    $sql = "UPDATE " . ItemManager::TABLE_NAME . " SET title = :title, content = :content, updated_at = :updated_at WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
    $query->execute();
  }

}


?>