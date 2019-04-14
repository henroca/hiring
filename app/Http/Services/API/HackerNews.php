<?php

namespace App\Http\Services\API;

/**
 * Monta as urls de acesso ao hacker news
 *
 * @author  Jefferson Henrique Ramos
 * @license MIT
 */
class HackerNews
{
    /**
     * URL base
     *
     * @var string
     */
    const BASE_PATH = 'https://hacker-news.firebaseio.com/v0/';

    /**
     * path para as top 500 histórias
     *
     * @var string
     */
    const TOP_STORIES = 'topstories.json';

    /**
     * URL para as top 500 histórias
     *
     * @return string $url
     */
    public function topStories()
    {
        return self::BASE_PATH . self::TOP_STORIES;
    }
}
