<?php

namespace UserApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IssueMailControllerTest extends WebTestCase
{
    public function testIssuestatechanged()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/issueStateChanged');
    }

}
