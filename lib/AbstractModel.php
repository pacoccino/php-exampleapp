<?php

namespace Lib;

class AbstractModel {

    public function toArray() {
        return get_object_vars($this);

    }
}