<?php

namespace Tests\AppBundle\Controller\Dtp\Standings;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayersControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde/hr1617/spieler');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Spieler', $crawler->filter('#content h2')->text());
    }
}
