<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PublicEquipesControllerTest extends WebTestCase
{
    public function testPofil()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{slug}');
    }

}
