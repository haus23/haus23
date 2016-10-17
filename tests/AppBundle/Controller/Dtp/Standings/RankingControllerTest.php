<?php

namespace Tests\AppBundle\Controller\Dtp\Standings;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RankingControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Tabelle', $crawler->filter('#content h2')->text());
    }
}
