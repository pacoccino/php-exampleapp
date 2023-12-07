<?php

namespace App\Models;

use Lib\AbstractModel;

class Comment extends AbstractModel {
    public $id;
    public $song_id;
    public $content;

    public function __construct($fields) {
        $this->id = isset($fields["id"]) ? $fields["id"] : null;
        $this->song_id = isset($fields["song_id"]) ? $fields["song_id"] : null;
        $this->content = isset($fields["content"]) ? $fields["content"] : null;
    }


}