<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DomainsPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDomainsPage()
    {
        $this->get('/domains');

        $domains = DB::table('domains')->limit(10)->get();

        foreach ($domains as $domain) {
            $this->assertContains(
                $domain->name, $this->response->getContent()
            );
        }

        $this->assertContains(
            'Page analyzer', $this->response->getContent()
        );
    }
}
