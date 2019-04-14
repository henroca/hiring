<?php

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
        $this->assertEquals(['timeout'  => 2.0], HttpRequest::getConfig());

        HttpRequest::addConfig(['base_uri' => 'http://httpbin.org']);

        $this->assertEquals(
            ['timeout'  => 2.0, 'base_uri' => 'http://httpbin.org'],
            HttpRequest::getConfig()
        );
    }

    /**
     * Faz uma requisição com o guzzle
     *
     * @test
     */
    public function make_request_with_guzzle()
    {
        $mock = new MockHandler([new Response(200, ['X-Foo' => 'Bar'])]);
        $handler = HandlerStack::create($mock);

        HttpRequest::addConfig(['handler' => $handler]);

        $response = HttpRequest::get('http://example.com.br');

        $this->assertEquals($response->getStatusCode(), 200);
    }
}
