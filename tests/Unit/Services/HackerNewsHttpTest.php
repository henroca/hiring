<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use GuzzleHttp\Psr7\Response;
use App\Http\Services\HttpRequest;
use App\Http\Services\HackerNewsHttp;
use App\Support\Collection;
use App\Models\Story;

/**
 * ClassNameTest
 * @group group
 */
class HackerNewsHttpTest extends TestCase
{
    private $story = '{
        "by" : "dhouston",
        "descendants" : 71,
        "id" : 8863,
        "kids" : [ 8952, 8934, 8876 ],
        "score" : 111,
        "time" : 1175714200,
        "title" : "My YC app: Dropbox - Throw away your USB drive",
        "type" : "story",
        "url" : "http://www.getdropbox.com/u/2/screencast.html"
    }';

    /**
     * Faz uma requisição para as novas histórias do hacker news
     *
     * @test
     */
    public function make_a_request_to_new_stories()
    {
        $mock = \Mockery::mock(HttpRequest::class);

        $mock->expects()->get('https://hacker-news.firebaseio.com/v0/newstories.json')
            ->andReturn(
                new Response(200, [], '[1, 2, 3, 4, 5]')
            );

        $http = new HackerNewsHttp();
        $http->registerRequest($mock);

        $this->assertEquals(new Collection([1, 2, 3, 4, 5]), $http->getNewStories());
    }

    /**
     * Faz uma requisição para uma história
     *
     * @test
     */
    public function make_a_request_to_a_specific_story()
    {
        $mock = \Mockery::mock(HttpRequest::class);

        $mock->expects()->get('https://hacker-news.firebaseio.com/v0/item/8863.json')
            ->andReturn(
                new Response(200, [], $this->story)
            );

        $http = new HackerNewsHttp();
        $http->registerRequest($mock);

        $story = new Story([
            "by" => "dhouston",
            "descendants" => 71,
            "id" => 8863,
            "kids" => [ 8952, 8934, 8876 ],
            "score" => 111,
            "time" => 1175714200,
            "title" => "My YC app: Dropbox - Throw away your USB drive",
            "type" => "story",
            "url" => "http://www.getdropbox.com/u/2/screencast.html"
        ]);

        $this->assertEquals($story, $http->getStory(8863));
    }
}
