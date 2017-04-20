<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PublicProjetsControllerTest extends WebTestCase
{
    public function testProfil()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{slug]');
    }

}
