<?php

namespace Lib;

class AbstractModel {
    public $id;

    public function toArray() {
        return get_object_vars($this);

    }

}