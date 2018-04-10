<?php

namespace Rest\Controller;

use App\Controller\AppController as BaseController;
use Rest\Error\RestError;

class AppController extends BaseController
{

    public $token = "";

    public $payload = [];

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize()
    {
        $authorization = $this->request->getAttribute('authorization');

        // set token
        $this->token = $authorization['token'];

        // set payload
        $this->payload = $authorization['payload'];

        parent::initialize();
    }
}
