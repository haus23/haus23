<?php

namespace tests\AppBundle\Controller\Dtp\Standings;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TipsControllerTest extends WebTestCase
{
    public function testMatchSelection()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde/hr1617/tipps/runde-3/2243/bayern-koeln');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Tippübersicht', $crawler->filter('#content h2')->text());
        $this->assertContains('Bayern', $crawler->filter('#content h2')->text());
    }
}
