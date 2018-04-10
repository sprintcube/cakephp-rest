<?php

namespace Rest\Controller;

class ErrorController extends AppController
{

    public function beforeRender(\Cake\Event\Event $event)
    {
        Log::info('Rest\Controller\ErrorController::beforeRender');
        parent::beforeRender($event);

        $this->viewBuilder()->className('Rest.Json');

        return null;
    }
}
