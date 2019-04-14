<?php

namespace App\Http\Services;

use App\Http\Services\API\HackerNews;

/**
 * Realiza as requisições para o hacker news
 *
 * @author  Jefferson Henrique Ramos
 * @license MIT
 */
class HackerNewsHttp
{
    /**
     * responsável para realizar as requisições
     *
     * @var mixed
     */
    private static $request;

    /**
     * Registra uma requisição
     *
     * @var mixed $request
     */
    public static function registerRequest($request)
    {
        self::$request = $request;
    }

    /**
     * Retorna uma array com os ids das novas histórias
     *
     * @return array $stories
     */
    public static function getNewStories() : array
    {
        $api = new HackerNews();
        $response = self::getResponse($api->newStories());

        return json_decode($response);
    }

    /**
     *
     * @return mixed $request
     */
    private static function getRequest()
    {
        return self::$request ?? HttpRequest::class;
    }

    /**
     * Retorna a resposta da requisição
     *
     * @return string $response
     */
    private static function getResponse($url) : string
    {
        $request = self::getRequest();

        return $request->get($url)->getBody()->getContents();
    }
}
