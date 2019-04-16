<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Services\HackerNewsHttp;
use App\Support\Collection;

class StoryControllerTest extends TestCase
{
    private $mock;

    /**
     * Listando as novas histórias por pagina.
     *
     * @test
     */
    public function returns_the_stories()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->mock->shouldReceive('load')
            ->with(\Mockery::type(Collection::class))
            ->andReturn($collection);

        $response = $this->json('GET', '/api/stories');

        $response->assertStatus(200)
            ->assertJson([
                'current_page'   => 1,
                'data'           => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                'first_page_url' => 'http://localhost/api/stories?page=1',
                'from'           => 1,
                'last_page'      => 2,
                'last_page_url'  => 'http://localhost/api/stories?page=2',
                'next_page_url'  => 'http://localhost/api/stories?page=2',
                'path'           => 'http://localhost/api/stories',
                'per_page'       => 10,
                'prev_page_url'  => null,
                'to'             => 10,
                'total'          => 12,
            ]
        );
    }

    /**
     * Testando a paginação
     *
     * @test
     */
    public function returns_the_second_page()
    {
        $collection = new Collection([10 => 11, 11 => 12]);

        $this->mock->shouldReceive('load')
            ->with(\Mockery::type(Collection::class))
            ->andReturn($collection);

        $response = $this->json('GET', '/api/stories?page=2');

        $response->assertStatus(200)
            ->assertJson([
                'current_page'   => 2,
                'data'           => [10 => 11, 11 => 12],
                'first_page_url' => 'http://localhost/api/stories?page=1',
                'from'           => 11,
                'last_page'      => 2,
                'last_page_url'  => 'http://localhost/api/stories?page=2',
                'next_page_url'  => null,
                'path'           => 'http://localhost/api/stories',
                'per_page'       => 10,
                'prev_page_url'  => 'http://localhost/api/stories?page=1',
                'to'             => 12,
                'total'          => 12,
            ]
        );
    }

    protected function setUp() : void
    {
        parent::setUp();

        $this->mock = \Mockery::mock(HackerNewsHttp::class);
        $this->mock->expects()->getNewStories()->andReturn(
            new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12])
        );

        $this->app->instance(HackerNewsHttp::class, $this->mock);
    }
}
