<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VisiteurControllerControllerTest extends WebTestCase
{
    public function testApercudepartement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/departement/');
    }

    public function testApercuequipe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/equipe/');
    }

    public function testApercuprojet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/projet/');
    }

    public function testApercuplateforme()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/plateforme/');
    }

}
