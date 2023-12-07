<?php

namespace Lib;

use PDO;

abstract class AbstractManager {
    protected $pdo;
    protected $tableName;
    protected $fieldTypes;

    protected function __construct($tableName, $fieldTypes) {
        $this->tableName = $tableName;
        $this->fieldTypes = $fieldTypes;

        $this->pdo = new PDO(
            "pgsql:host=".$_ENV['DB_HOST'].";port=".$_ENV['DB_PORT'].";dbname=".$_ENV['DB_NAME'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD']
        );
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->exec('SET NAMES \'utf8\'');
    }

    public function getItems(int $limit): array {
        $sql = "SELECT * FROM ".$this->tableName." LIMIT :limit";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        $items = $query->fetchAll();
        $query->closeCursor();
        return $items;
    }
    public function getItem(string $id): array {
        $sql = "SELECT * FROM ".$this->tableName." WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $item = $query->fetch();
        $query->closeCursor();
        return $item;
    }
    public function addItem(array $fields): string {

        $fieldNames = array_keys($fields);
        $paramNames = array_map(fn($name) => ":$name", $fieldNames);

        $sql = "INSERT INTO ".$this->tableName." (".
            implode(",", $fieldNames)
            .") VALUES (".
            implode(",", $paramNames)
            .") RETURNING id;";
        $query = $this->pdo->prepare($sql);

        foreach($fieldNames as $fieldName) {
            $query->bindParam(":$fieldName", $fields[$fieldName], $this->fieldTypes[$fieldName]);
        }

        $query->execute();
        $lastInsertId = $query->fetchColumn();
        return $lastInsertId;
    }
    public function editItem(string $id, array $fields): void {
        $fieldNames = array_keys($fields);

        $sql = "UPDATE ".$this->tableName." SET ".
            implode(",", array_map(fn($fieldName) => "$fieldName = :$fieldName", $fieldNames))
            ." WHERE id = :id";

        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);

        foreach($fieldNames as $fieldName) {
            $query->bindParam(":$fieldName", $fields[$fieldName], $this->fieldTypes[$fieldName]);
        }

        $query->execute();
    }
    public function deleteItem(string $id): void {
        $sql = "DELETE FROM ".$this->tableName." WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
    }
}

?>