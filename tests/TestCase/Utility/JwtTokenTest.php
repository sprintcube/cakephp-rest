<?php

namespace Rest\Test\TestCase\Utility;

use Cake\TestSuite\TestCase;
use Rest\Utility\JwtToken;

class JwtTokenTest extends TestCase
{

    /**
     * test generate function
     */
    public function testGenerate()
    {
        $payload = [
            'id' => 1,
            'email' => 'john@example.com'
        ];

        $this->assertNotEmpty(JwtToken::generate($payload));
        $this->assertEquals(false, JwtToken::generate());
    }
}
