<?php

namespace Core;

class Entity {

    public $id;
    public $id_value;
    function __construct($arr)
    {
        $this->id = array_key_first($arr);
        $this->id_value = $arr[array_key_first($arr)];
    }
}