<?php

namespace App\Models;

use Lib\AbstractModel;

class Playlist extends AbstractModel {
    public $title;
    public $created_at;

    public function __construct($fields) {
        $this->id = isset($fields["id"]) ? $fields["id"] : null;
        $this->title = isset($fields["title"]) ? $fields["title"] : null;
        $this->created_at = isset($fields["created_at"]) ? $fields["created_at"] : null;
    }
}