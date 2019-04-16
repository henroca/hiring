<?php

namespace App\Models;

/**
 * Model Story
 *
 * @author  Jefferson Henrique Ramos
 * @license MIT
 */
class Story
{
    private $attributes = [];

    public function __construct($attributes = [])
    {
        $this->setAttributes($attributes);
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        return @$this->attributes[$name];
    }

    private function setAttributes($attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }
}
