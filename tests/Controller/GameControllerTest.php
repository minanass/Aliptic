<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
       // $this->assertSelectorTextContains('h1', 'Hello World');
    }

    public function testNewPlayer()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=> 'mina',
            'PHP_AUTH_PW' => 'jeu71'
        ]);
        //$client->followRedirect();
        $crawler = $client->request('GET', '/game');

        $this->assertResponseIsSuccessful();
       // $this->assertSelectorTextContains('h1', 'Hello World');
       
    }
}
