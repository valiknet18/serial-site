<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PeopleControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/peoples/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/admin/peoples/'.md5(rand(1,100)));

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testShowCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/peoples/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/admin/peoples/create/'.md5(rand(1,100)));

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testShowEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/peoples/stroman-zetta/edit');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/admin/peoples/stroman-zetta/edit/'.md5(rand(1,100)));

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
