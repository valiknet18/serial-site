<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SerialControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/admin/'.md5(rand(1,100)));

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testShowCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/serials/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/admin/serials/create/'.md5(rand(1,100)));

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testShowEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/serials/non/edit');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/admin/serials/non/edit/'.md5(rand(1,100)));

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
