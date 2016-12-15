<?php

namespace Tests\AppBundle\Controller\Dtp\Backend;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{
    public function testIndexRequiresAuthentication()
    {
        $client = static::createClient();

        $client->request('GET', '/tipprunde/admin/');

        $this->assertTrue(
            $client->getResponse()->isRedirect('http://localhost/login'),
            'response is a redirect to /login'
        );
    }

    public function testIndexWithAuthentication()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER' => 'micha',
            'PHP_AUTH_PW'   => 'secret'
        ]);

        $client->request('GET', '/tipprunde/admin/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
