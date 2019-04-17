<?php

namespace App\Http\Services;

use App\Http\Services\API\HackerNews;
use App\Support\Collection;
use App\Models\Story;
use Illuminate\Support\Facades\Cache;

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

    /**
     * responsável por gerar as url para as requisições
     *
     * @var App\Http\Services\API\HackerNews
     */
    private $api;


    public function __construct()
    {
        $this->registerRequest(new HttpRequest);
        $this->api = new HackerNews();
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
     * Retorna uma collection com os ids das novas histórias
     *
     * @return Collection $stories
     */
    public function getNewStories() : Collection
    {
        $response = $this->getResponse($this->api->newStories());

        return new Collection(json_decode($response));
    }

    /**
     * Retorna uma collection com a história
     *
     * @return Story $story
     */
    public function getStory($id) : Story
    {
        $response = $this->getResponse($this->api->story(compact('id')));

        return new Story(json_decode($response));
    }

    /**
     * Retorna uma collection com as histórias
     *
     * @return Collection $stories
     */
    public function load(Collection $stories) : Collection
    {
        return $stories->map(function ($story) {
            return $this->getStory($story)->jsonSerialize();
        });
    }

    /**
     * Apaga o cache para novas histórias
     */
    public function forgetCache()
    {
        Cache::forget("request:{$this->api->newStories()}");
    }

    /**
     * Retorna a resposta da requisição
     *
     * @return string $response
     */
    private function getResponse($url) : string
    {
        $key = "request:{$url}";

        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $response = $this->request->get($url)->getBody()->getContents();

        Cache::put($key, $response, now()->addHours(3));

        return $response;
    }
}
