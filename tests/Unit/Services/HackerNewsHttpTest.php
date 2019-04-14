<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use GuzzleHttp\Psr7\Response;
use App\Http\Services\HttpRequest;
use App\Http\Services\HackerNewsHttp;
use App\Support\Collection;

/**
 * ClassNameTest
 * @group group
 */
class HackerNewsHttpTest extends TestCase
{
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
}
