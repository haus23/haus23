<?php

namespace Tests\AppBundle\Controller\Dtp\Backend;

use AppBundle\Controller\Dtp\Backend\PlayerController;
use AppBundle\Entity\DTP\Tournament;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class PlayerControllerTest extends WebTestCase
{
    public function testCreateWithEmptySessionRedirectsToDashboard()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'micha',
            'PHP_AUTH_PW' => 'secret'
        ]);

        $client->request('GET', '/tipprunde/admin/player/create');

        $this->assertTrue(
            $client->getResponse()->isRedirect('/tipprunde/admin'),
            'response is a redirect to /tipprunde/admin'
        );
    }

    public function testCreate()
    {
        $session = new Session(new MockArraySessionStorage());
        $session->set('dtp.backend.tournament', new Tournament());

        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'micha',
            'PHP_AUTH_PW' => 'secret'
        ]);

        $client->request('GET', '/tipprunde/admin/player/create');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
