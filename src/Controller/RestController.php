<?php

namespace Rest\Controller;

use Cake\Event\Event;

class RestController extends AppController
{

    /**
     * beforeRender callback
     *
     * @param Event $event An Event instance
     * @return null
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        $this->viewBuilder()->className('Rest.Json');

        return null;
    }
}
