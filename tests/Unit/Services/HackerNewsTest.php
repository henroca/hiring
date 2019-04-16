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
     * Retorna uma rota base para o hacker news.
     *
     * @test
     */
    public function returns_base_path_to_hacker_news()
    {
        $basePath = 'https://hacker-news.firebaseio.com/v0/';

        $this->assertEquals($basePath, HackerNews::BASE_PATH);
    }

    /**
     * retorna a rota para o novas histórias do hacker news
     *
     * @test
     */
    public function resturns_path_to_get_stories()
    {
        $path = 'https://hacker-news.firebaseio.com/v0/newstories.json';
        $hackerNews = new HackerNews();

        $this->assertEquals('newstories.json', HackerNews::TOP_STORIES);
        $this->assertEquals($path, $hackerNews->newStories());
    }

    /**
     * retorna a rota para uma história
     *
     * @test
     */
    public function resturns_path_to_story()
    {
        $path = 'https://hacker-news.firebaseio.com/v0/item/10.json';
        $hackerNews = new HackerNews();

        $this->assertEquals('item/:id.json', HackerNews::STORY);
        $this->assertEquals($path, $hackerNews->story(['id' => 10]));
    }
}
