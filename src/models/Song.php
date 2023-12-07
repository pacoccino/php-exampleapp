<?php

namespace App\Models;

use Lib\AbstractModel;

class Song extends AbstractModel {
    public $title;
    public $content;
    public $created_at;

    public function __construct($fields) {
        $this->id = isset($fields["id"]) ? $fields["id"] : null;
        $this->title = isset($fields["title"]) ? $fields["title"] : null;
        $this->content = isset($fields["content"]) ? $fields["content"] : null;
        $this->created_at = isset($fields["created_at"]) ? $fields["created_at"] : null;
    }
}