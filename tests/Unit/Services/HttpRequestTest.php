<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use App\Http\Services\HttpRequest;
use GuzzleHttp\Psr7\Response;

/**
 * HttpRequestTest
 * @group services
 */
class HttpRequestTest extends TestCase
{
    /**
     * Adicionando uma configuração nova para usar na requisição
     *
     * @test
     */
    public function add_a_new_config()
    {
        $http = new HttpRequest();

        $this->assertEquals(['timeout'  => 10.0], $http->getConfig());

        $http->addConfig(['base_uri' => 'http://httpbin.org']);

        $this->assertEquals(
            ['timeout'  => 10.0, 'base_uri' => 'http://httpbin.org'],
            $http->getConfig()
        );
    }

    /**
     * Faz uma requisição com o guzzle
     *
     * @test
     */
    public function make_request_with_guzzle()
    {
        $mock = new MockHandler([new Response(200, ['X-Foo' => 'Bar'], 'response')]);
        $handler = HandlerStack::create($mock);

        $http = new HttpRequest();

        $http->addConfig(['handler' => $handler]);

        $response = $http->get('http://example.com.br');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['Bar'], $response->getHeader('X-Foo'));
        $this->assertEquals('response', $response->getBody()->getContents());
    }
}
