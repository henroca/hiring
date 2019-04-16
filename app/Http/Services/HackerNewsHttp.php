<?php

namespace App\Http\Services;

use App\Http\Services\API\HackerNews;
use App\Support\Collection;
use App\Models\Story;

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
    private $request;

    public function __construct()
    {
        $this->registerRequest(new HttpRequest);
    }

    /**
     * Registra uma requisição
     *
     * @var HttpRequest $request
     */
    public function registerRequest($request)
    {
        $this->request = $request;
    }

    /**
     * Retorna uma array com os ids das novas histórias
     *
     * @return array $stories
     */
    public function getNewStories() : Collection
    {
        $api = new HackerNews();
        $response = $this->getResponse($api->newStories());

        return new Collection(json_decode($response));
    }

    public function getStory($id) : Story
    {
        $api = new HackerNews();
        $response = $this->getResponse($api->story(compact('id')));

        return new Story(json_decode($response));
    }

    /**
     * Retorna a resposta da requisição
     *
     * @return string $response
     */
    private function getResponse($url) : string
    {
        return $this->request->get($url)->getBody()->getContents();
    }
}
