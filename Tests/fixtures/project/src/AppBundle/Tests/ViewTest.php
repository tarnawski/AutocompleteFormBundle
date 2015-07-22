<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{

    private $client;

    public function testDisplayingPostPage()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }
}
