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
        $this->assertContains('Runde 3', $crawler->filter('#content h3')->text());
        $this->assertContains('Bayern', $crawler->filter('#content h3')->text());
    }


    public function testInvalidRoundReturnsStatus404()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde/hr1617/tipps/runde-0/2243/bayern-koeln');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testFixtureRouteParameterIsOptional()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde/hr1617/tipps/runde-3/2243');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Runde 3', $crawler->filter('#content h3')->text());
        $this->assertContains('Bayern', $crawler->filter('#content h3')->text());
    }

    public function testMatchIdRouteParameterIsOptional()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde/hr0203/tipps/runde-3');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Deutschland', $crawler->filter('#content h3')->text());
    }

    public function testRoundNrRouteParameterIsOptional()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde/hr0203/tipps');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Energie', $crawler->filter('#content h3')->text());
    }
}
