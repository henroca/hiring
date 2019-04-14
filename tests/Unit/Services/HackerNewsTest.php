<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Http\Services\API\HackerNews;

/**
 * HttpRequestTest
 * @group services
 */
class HackerNewsTest extends TestCase
{
    /**
     * Retorna um path base para o hacker news.
     *
     * @test
     */
    public function returns_base_path_to_hacker_news()
    {
        $basePath = 'https://hacker-news.firebaseio.com/v0/';

        $this->assertEquals($basePath, HackerNews::BASE_PATH);
    }

    /**
     * retorna o path para o top 500 histórias do hacker news
     *
     * @test
     */
    public function resturns_path_to_get_stories()
    {
        $path = 'https://hacker-news.firebaseio.com/v0/topstories.json';
        $hackerNews = new HackerNews();

        $this->assertEquals('topstories.json', HackerNews::TOP_STORIES);
        $this->assertEquals($path, $hackerNews->topStories());
    }
}
