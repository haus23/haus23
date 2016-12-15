<?php

namespace Tests\AppBundle\Controller\Dtp\Backend;

use AppBundle\Controller\Dtp\Backend\TournamentController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TournamentControllerTest extends WebTestCase
{
    public function testCreateWithAuthentication()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER' => 'micha',
            'PHP_AUTH_PW'   => 'secret'
        ]);

        $client->request('GET', '/tipprunde/admin/tournament/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
