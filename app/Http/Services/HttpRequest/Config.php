<?php

namespace App\Http\Services\HttpRequest;

trait Config
{
    /**
     *
     * @var array
     */
    private $config;

    /**
     *
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     *
     * @return array $config
     */
    public function getConfig() : array
    {
        return $this->config;
    }

    /**
     * Adiciona uma configuração para as requisições
     *
     * @param array $config
     */
    public function addConfig(array $config)
    {
        $this->setConfig(array_merge($this->getConfig(), $config));
    }
}
