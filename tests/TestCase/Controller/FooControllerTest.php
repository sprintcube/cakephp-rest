<?php

namespace Rest\Test\TestCase\Controller;

use Cake\Event\Event;
use Cake\TestSuite\IntegrationTestCase;

/**
 * FooControllerTest Test Case
 */
class FooControllerTest extends IntegrationTestCase
{

    /**
     * Test method
     *
     * @return void
     */
    public function testGet()
    {
        $this->get('/foo/bar');
        $this->assertResponseOk();
        $this->assertResponseCode(200);
        $this->assertResponseEquals('{"status":"OK","result":{"bar":{"falanu":["dhikanu","tamburo"]}}}');
    }

    /**
     * Test method
     *
     * @return void
     */
    public function testGetWithHeaders()
    {
        $payload = [
            'id' => 1,
            'email' => "johndoe@example.com"
        ];

        $token = \Rest\Utility\JwtToken::generate($payload);

        $this->configRequest([
            'headers' => [
                'Authorization' => "Bearer {$token}"
            ]
        ]);


        $this->get('/foo/doe');

        $this->assertResponseOk();
        $this->assertResponseCode(200);
        $this->assertResponseEquals('{"status":"OK","result":{"data":{"requireToken":true}}}');
    }
}
