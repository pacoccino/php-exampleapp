<?php

namespace Lib;

use PDO;

class Manager
{
    private string $ModelClass;
    private static ?PDO $pdo = null;

    private function __construct(string $ModelClass)
    {
        $this->ModelClass = $ModelClass;

        if (Manager::$pdo === null) {
            Manager::$pdo = new PDO(
                "pgsql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD']
            );
            Manager::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            Manager::$pdo->exec('SET NAMES \'utf8\'');
        }
    }

    public static function getClassManager(string $ModelClass)
    {
        return new self($ModelClass);
    }
    public function getItems(int $limit): array
    {
        $sql = "SELECT * FROM " . $this->ModelClass::TABLE_NAME . " LIMIT :limit";
        $query = Manager::$pdo->prepare($sql);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        $items = $query->fetchAll();
        $query->closeCursor();
        $models = array_map(fn($item) => new $this->ModelClass($item, $this), $items);
        return $models;
    }

    public function getItemsRelatedTo(string $relationName, string $relatedToId, int $limit): array
    {
        $sql = "SELECT * FROM " . $this->ModelClass::TABLE_NAME . " WHERE $relationName = :relatedToId LIMIT :limit";
        $query = Manager::$pdo->prepare($sql);
        $query->bindParam(':relatedToId', $relatedToId, PDO::PARAM_STR);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        $items = $query->fetchAll();
        $query->closeCursor();
        $models = array_map(fn($item) => new $this->ModelClass($item, $this), $items);
        return $models;
    }
    public function getItem(string $id): AbstractModel
    {
        $sql = "SELECT * FROM " . $this->ModelClass::TABLE_NAME . " WHERE id = :id";
        $query = Manager::$pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $item = $query->fetch();
        $query->closeCursor();
        $model = new $this->ModelClass($item, $this);
        return $model;
    }
    public function createItem(array $fields): AbstractModel
    {
        $fieldNames = array_keys($fields);
        $fieldNames = array_filter($fieldNames, fn($fieldName) => isset($fields[$fieldName]));
        $paramNames = array_map(fn($name) => ":$name", $fieldNames);

        $sql = "INSERT INTO " . $this->ModelClass::TABLE_NAME . " (" .
            implode(",", $fieldNames)
            . ") VALUES (" .
            implode(",", $paramNames)
            . ") RETURNING id;";
        $query = Manager::$pdo->prepare($sql);

        foreach ($fieldNames as $fieldName) {
            $query->bindParam(":$fieldName", $fields[$fieldName], $this->ModelClass::FIELD_TYPES[$fieldName]);
        }

        $query->execute();
        $lastInsertId = $query->fetchColumn();

        return $this->getItem($lastInsertId);
    }

    public function editItem(AbstractModel $model): void
    {
        $fields = $model->toArray();
        $fieldNames = array_keys($fields);
        $fieldNames = array_filter($fieldNames, fn($fieldName) => isset($fields[$fieldName]));

        $sql = "UPDATE " . $this->ModelClass::TABLE_NAME . " SET " .
            implode(",", array_map(fn($fieldName) => "$fieldName = :$fieldName", $fieldNames))
            . " WHERE id = :id";

        $query = Manager::$pdo->prepare($sql);
        $query->bindParam(':id', $model->id, PDO::PARAM_STR);

        foreach ($fieldNames as $fieldName) {
            if (isset($fields[$fieldName]))
                $query->bindParam(":$fieldName", $fields[$fieldName], $this->ModelClass::FIELD_TYPES[$fieldName]);
        }

        $query->execute();
    }
    public function deleteItem(string $id): void
    {
        $sql = "DELETE FROM " . $this->ModelClass::TABLE_NAME . " WHERE id = :id";
        $query = Manager::$pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
    }
}

?>