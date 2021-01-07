<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('h1', 'Hello World');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
