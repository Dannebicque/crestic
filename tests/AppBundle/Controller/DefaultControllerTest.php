<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

//        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
//        $stack = [];
//        $this->assertEquals(0, count($stack));
//
//        array_push($stack, 'foo');
//        $this->assertEquals('foo', $stack[count($stack)-1]);
//        $this->assertEquals(1, count($stack));
//
//        $this->assertEquals('foo', array_pop($stack));
//        $this->assertEquals(0, count($stack));
    }
}
