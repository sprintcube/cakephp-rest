<?php

use Cake\Event\EventManager;
use Rest\Middleware\AuthorizationMiddleware;
use Rest\Middleware\RestErrorMiddleware;
use Rest\Middleware\RestMiddleware;

EventManager::instance()->on(
    'Server.buildMiddleware',
    function ($event, $middlewareQueue) {

        $middlewareQueue->insertAfter(
            'Cake\Routing\Middleware\RoutingMiddleware',
            new RestMiddleware()
        );

        $middlewareQueue->insertAfter(
            'Rest\Middleware\RestMiddleware',
            new RestErrorMiddleware()
        );

        $middlewareQueue->insertAfter(
            'Rest\Middleware\RestErrorMiddleware',
            new AuthorizationMiddleware()
        );
    }
);

/*
 * Read and inject configuration
 */
try {
    Cake\Core\Configure::load('Rest.rest', 'default', false);
    Cake\Core\Configure::load('rest', 'default', true);
} catch (\Exception $e) {
    // do nothing
}
