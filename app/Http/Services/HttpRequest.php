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
    use Config;

    /**
     * Configuração basica para as requests
     *
     * @var array
     */
    const BASE_CONFIG = ['timeout'  => 10.0];

    /**
     *
     */
    public function __construct()
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
        $client = new Client($this->getConfig());
        return $client->request('GET', $path);
    }

    /**
     * Faz uma request do tipo GET
     *
     * @param string $path
     * @return mixed $response
     */
    public function get(string $path)
    {
        return $this->makeRequest($path);
    }
}
