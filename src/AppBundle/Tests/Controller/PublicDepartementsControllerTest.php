<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PublicDepartementsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testVoir()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/voir/{slug}');
    }

}
