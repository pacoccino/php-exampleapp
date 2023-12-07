<?php

namespace Lib;

abstract class AbstractModel
{
    protected $manager;
    public $id;

    protected function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function toArray()
    {
        return get_object_vars($this);

    }

    public function delete()
    {
        return $this->manager->deleteItem($this);
    }
    public function edit()
    {
        return $this->manager->editItem($this);
    }
}