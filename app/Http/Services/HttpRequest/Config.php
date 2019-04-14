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
    private function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     *
     * @return array $config
     */
    private function getConfig() : array
    {
        return $this->config;
    }
}
