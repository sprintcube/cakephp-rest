<?php
namespace Rest\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use Rest\Controller\AppController;

/**
 * Rest\Controller\AppController Test Case
 */
class AppControllerTest extends IntegrationTestCase
{

    public $controller = null;

    /**
     * Setup method.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        // $request = new Request();
        // $response = new Response();
        // $this->controller = $this->getMockBuilder('Rest\Controller\AppController')
        //     ->setConstructorArgs([$request, $response])
        //     ->setMethods(null)
        //     ->getMock();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
