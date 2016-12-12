<?php

namespace tests\AppBundle\Controller\Dtp\Standings;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MatchesControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde/hr1617/spiele');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Spielübersicht', $crawler->filter('#content h3')->text());
    }
}
