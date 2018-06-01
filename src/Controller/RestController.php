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

        $this->viewBuilder()->setClassName('Rest.Json');

        return null;
    }
}
