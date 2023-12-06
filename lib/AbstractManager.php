<?php

namespace Lib;

use PDO;

abstract class AbstractManager {
    protected $pdo;
    protected $tableName;

    protected function __construct($tableName) {
        $this->tableName = $tableName;

        $this->pdo = new PDO(
            "pgsql:host=".$_ENV['DB_HOST'].";port=".$_ENV['DB_PORT'].";dbname=".$_ENV['DB_NAME'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD']
        );
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->exec('SET NAMES \'utf8\'');
    }

}

?>