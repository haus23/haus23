<?php

namespace Tests\AppBundle\Controller\Dtp\Standings;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RankingControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Tabelle', $crawler->filter('#content h3')->text());
    }

    public function testChampionshipSelection()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tipprunde/hr0203');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Tabelle', $crawler->filter('#content h3')->text(),'',true);
        $this->assertContains('Hinrunde 2002/03', $crawler->filter('#dtp-nav')->text());

    }
}
