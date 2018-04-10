<?php

namespace Rest\Middleware;

use Cake\Core\Configure;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Rest middleware
 */
class RestMiddleware
{

    /**
     * Invoke method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Message\ResponseInterface $response The response.
     * @param callable $next Callback to invoke the next middleware.
     * @return \Psr\Http\Message\ResponseInterface A response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $params = (array)$request->getAttribute('params', []);

        if (isset($params['isRest']) && $params['isRest']) {
            Configure::write('useRestErrorHandler', true);
        }

        $response = $next($request, $response);

        return $response;
    }
}
