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
    const TOP_STORIES = 'newstories.json';

    /**
     * path para uma história
     *
     * @var string
     */
    const STORY = 'item/:id.json';

    /**
     * URL para as top 500 histórias
     *
     * @return string $url
     */
    public function newStories()
    {
        return self::BASE_PATH . self::TOP_STORIES;
    }

    /**
     * URL para uma história
     *
     * @return string $url
     */
    public function story($params)
    {
        $path = '';

        foreach ($params as $key => $value) {
            $path = str_replace(":{$key}", $value, self::STORY);
        }

        return self::BASE_PATH . $path;
    }
}
