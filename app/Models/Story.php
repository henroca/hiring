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
    /**
     * Attributos da instância
     *
     * @var array
     */
    private $attributes = [];

    /**
     *
     * @param array $attributes
     */
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

    /**
     * Cria os atributos
     *
     * @param array $attributes
     */
    private function setAttributes($attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Retorna a instância em formato de array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * Converte a instância em json
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
