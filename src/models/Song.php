<?php

namespace App\Models;

use PDO;
use Lib\Manager;
use Lib\AbstractModel;

class Song extends AbstractModel
{
    public $title;
    public $content;
    public $created_at;

    const TABLE_NAME = 'songs';
    const FIELD_TYPES = [
        'id' => PDO::PARAM_STR,
        'title' => PDO::PARAM_STR,
        'content' => PDO::PARAM_STR,
    ];

    public function __construct($fields, $manager)
    {
        parent::__construct($manager);
        $this->id = isset($fields["id"]) ? $fields["id"] : null;
        $this->title = isset($fields["title"]) ? $fields["title"] : null;
        $this->content = isset($fields["content"]) ? $fields["content"] : null;
        $this->created_at = isset($fields["created_at"]) ? $fields["created_at"] : null;
    }

    public function getComments(int $limit)
    {
        $commentManager = Manager::getClassManager(Comment::class);
        return $commentManager->getItemsRelatedTo('song_id', $this->id, $limit);
    }

}