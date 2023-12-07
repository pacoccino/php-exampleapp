<?php

namespace App\Models;

use PDO;
use Lib\AbstractModel;

class Playlist extends AbstractModel
{
    public string $title;
    public string $created_at;

    const TABLE_NAME = 'playlists';
    const FIELD_TYPES = [
        'id' => PDO::PARAM_STR,
        'content' => PDO::PARAM_STR,
    ];

    public function __construct($fields, $manager)
    {
        parent::__construct($manager);
        $this->id = isset($fields["id"]) ? $fields["id"] : null;
        $this->title = isset($fields["title"]) ? $fields["title"] : null;
        $this->created_at = isset($fields["created_at"]) ? $fields["created_at"] : null;
    }
}