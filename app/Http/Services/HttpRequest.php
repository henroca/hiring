<?php

namespace App\Http\Services;

use App\Http\Services\HttpRequest\Config;
use GuzzleHttp\Client;

/**
 * Faz as requisições http
 *
 * @author  Jefferson Henrique Ramos
 * @license MIT
 */
class HttpRequest
{
    use Config { getConfig as getHttpConfig; }

    /**
     * Configuração basica para as requests
     *
     * @var array
     */
    const BASE_CONFIG = ['timeout'  => 2.0];

    /**
     * Instância de HttpRequest
     *
     * @var HttpRequest
     */
    static $instance;

    /**
     *
     */
    private function __construct()
    {
        $this->setConfig(self::BASE_CONFIG);
    }

    /**
     * Faz uma request do tipo GET
     *
     * @param string $path
     * @return mixed $response
     */
    public function makeRequest(string $path)
    {
        $client = new Client($this->getHttpConfig());
        return $client->request('GET', $path);
    }

    /**
     * Faz uma request do tipo GET
     *
     * @param string $path
     * @return mixed $response
     */
    public static function get(string $path)
    {
        return self::getInstance()->makeRequest($path);
    }

    /**
     * Adiciona uma configuração para as requisições
     *
     * @param array $config
     */
    public static function addConfig(array $config)
    {
        $oldConfig = self::getInstance()->getHttpConfig();
        self::getInstance()->setConfig(array_merge($oldConfig, $config));
    }

    /**
     * Retorna a configuração das requisições
     *
     * @return array $config
     */
    public static function getConfig() : array
    {
        return self::getInstance()->getHttpConfig();
    }

    /**
     * Retorna uma instancia de HttpRequest, se não existir cria uma
     *
     * @return HttpRequest $instance
     */
    private static function getInstance() : HttpRequest
    {
        if (is_null(self::$instance)) {
            return self::$instance = new HttpRequest();
        }

        return self::$instance;
    }
}
