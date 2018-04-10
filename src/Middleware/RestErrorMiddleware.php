<?php

namespace Rest\Middleware;

use Cake\Core\Configure;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Rest middleware
 */
class RestErrorMiddleware extends ErrorHandlerMiddleware
{

    /**
     * Invoke method.
     *
     * @param ServerRequestInterface $request The request.
     * @param ResponseInterface $response The response.
     * @param callable $next Callback to invoke the next middleware.
     * @return ResponseInterface A response
     */
    public function __invoke($request, $response, $next)
    {
        if (Configure::read('useRestErrorHandler')) {
            try {
                $this->exceptionRenderer = \Rest\Error\RestExceptionRenderer::class;

                return $next($request, $response);
            } catch (Exception $e) {
                return $this->handleException($e, $request, $response);
            }
        } else {
            return $next($request, $response);
        }
    }
}
