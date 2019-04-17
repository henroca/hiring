<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use GuzzleHttp\Psr7\Response;
use App\Http\Services\HttpRequest;
use App\Http\Services\HackerNewsHttp;
use App\Support\Collection;
use App\Models\Story;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

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
        $story = $this->getStory();

        $this->assertEquals($story, $http->getStory(8863));
    }

    /**
     * Carrega as histórias requisitadas
     *
     * @test
     */
    public function load_histories()
    {
        $mock = \Mockery::mock(HttpRequest::class);

        $mock->expects()->get('https://hacker-news.firebaseio.com/v0/item/8863.json')
            ->andReturn(
                new Response(200, [], $this->story)
            );

        $http = new HackerNewsHttp();
        $http->registerRequest($mock);
        $story = $this->getStory()->jsonSerialize();

        $this->assertEquals(new Collection([$story]), $http->load(new Collection([8863])));
    }

    /**
     * Deve criar um cache da requisição
     *
     * @test
     */
    public function creates_cache_from_request()
    {
        $path = 'https://hacker-news.firebaseio.com/v0/newstories.json';
        $key = "request:{$path}";

        $mock = \Mockery::mock(HttpRequest::class);

        $mock->expects()->get($path)
            ->andReturn(
                new Response(200, [], '[1, 2, 3, 4, 5]')
            );

        $http = new HackerNewsHttp();
        $http->registerRequest($mock);

        Cache::shouldReceive('has')->once()->with($key)
            ->andReturn(false);

        Cache::shouldReceive('put')->once()->with($key, '[1, 2, 3, 4, 5]', \Mockery::type(Carbon::class))
            ->andReturn('[1, 2, 3, 4, 5]');

        $this->assertEquals(new Collection([1, 2, 3, 4, 5]), $http->getNewStories());
    }

    /**
     * Deve apagar o cache das novas histórias
     *
     * @test
     */
    public function forget_cache_from_new_stories()
    {
        $path = 'https://hacker-news.firebaseio.com/v0/newstories.json';
        $key = "request:{$path}";
        Cache::shouldReceive('forget')->once()->with($key);

        $http = new HackerNewsHttp();
        $http->forgetCache();
    }

    private function getStory()
    {
        return new Story([
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
    }
}
