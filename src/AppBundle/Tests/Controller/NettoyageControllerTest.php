<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NettoyageControllerTest extends WebTestCase
{
    public function testClearmembres()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/clearMembres');
    }

    public function testClearpublications()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/clearPublications');
    }

    public function testClearmembresext()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/clearMembresExt');
    }

    public function testUpdatemembres()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateMembres');
    }

    public function testUpdatepublications()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updatePublications');
    }

    public function testUpdatemembresext()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateMembresExt');
    }

}
