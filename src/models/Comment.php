<?php

namespace App\Models;

use PDO;
use Lib\AbstractModel;

class Comment extends AbstractModel
{
    public string $song_id;
    public string $content;

    const TABLE_NAME = 'comments';
    const FIELD_TYPES = [
        'id' => PDO::PARAM_STR,
        'content' => PDO::PARAM_STR,
        'song_id' => PDO::PARAM_STR,
    ];

    public function __construct($fields, $manager)
    {
        parent::__construct($manager);
        $this->id = isset($fields["id"]) ? $fields["id"] : null;
        $this->song_id = isset($fields["song_id"]) ? $fields["song_id"] : null;
        $this->content = isset($fields["content"]) ? $fields["content"] : null;
    }
}