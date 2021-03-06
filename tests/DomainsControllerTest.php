<?php

//namespace App\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class DomainsPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowAllDomains()
    {
        $url = route('showDomains');
        $this->get($url);

        $domains = \DB::table('domains')->limit(10)->get();

        foreach ($domains as $domain) {
            $this->assertContains(
                $domain->name,
                $this->response->getContent()
            );
        }
    }

    /**
     * @dataProvider additionProvider
     */
    public function testShowOneDomain($expected, $id)
    {
        $url = route('showDomain', ['id' => $id]);
        $this->get($url);
        $this->assertContains($expected, $this->response->getContent());
    }

    public function additionProvider()
    {
        return [
            ['http://youtube.com', 1],
            ['http://yandex.com', 2],
            ['http://vk.com', 3],
            ['http://facebook.com', 4]
        ];
    }

    public function testAddDomain()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Length' => 13], '!DOCTYPE html')
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $this->app->instance(\GuzzleHttp\Client::class, $client);

        $url = route('addDomain', ['url' => 'http://test.com']);
        $this->post($url);
        $this->seeInDatabase('domains', [
            'name' => 'http://test.com',
            'response_body' => '!DOCTYPE html',
            'response_content_length' => 13,
            'response_code' => 200
        ]);
    }
}
