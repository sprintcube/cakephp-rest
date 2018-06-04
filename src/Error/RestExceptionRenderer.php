<?php

namespace Rest\Error;

use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\Error\ExceptionRenderer;
use Cake\Log\Log;
use Rest\Controller\ErrorController;

class RestExceptionRenderer extends ExceptionRenderer
{
    /**
     * Renders the response for the exception.
     *
     * @return \Cake\Http\Response The response to be sent.
     */
    public function render()
    {
        $exception = $this->error;
        $code = $this->_code($exception);

        $unwrapped = $this->_unwrap($exception);

        if ($exception instanceof \Rest\Routing\Exception\MissingTokenException ||
            $exception instanceof \Rest\Routing\Exception\InvalidTokenException ||
            $exception instanceof \Rest\Routing\Exception\InvalidTokenFormatException
        ) {
            $message = $exception->getMessage();
        } else {
            $message = $this->_message($exception, $code);
        }

        $response = $this->controller->getResponse();

        if ($exception instanceof CakeException) {
            foreach ((array)$exception->responseHeader() as $key => $value) {
                $response = $response->withHeader($key, $value);
            }
        }
        $response = $response->withStatus($code);

        $viewVars = [
            'message' => $message,
            'code' => $code
        ];

        $isDebug = Configure::read('debug');

        if ($isDebug) {
            $viewVars['trace'] = Debugger::formatTrace($unwrapped->getTrace(), [
                    'format' => 'array',
                    'args' => false
            ]);
            $viewVars['file'] = $exception->getFile() ? : 'null';
            $viewVars['line'] = $exception->getLine() ? : 'null';
        }

        $this->controller->set($viewVars);

        if ($unwrapped instanceof CakeException && $isDebug) {
            $this->controller->set($unwrapped->getAttributes());
        }

        $this->controller->response = $response;

        return $this->_prepareResponse();
    }

    /**
     * Generates the response using the controller object.
     *
     * @return \Cake\Http\Response A response object that can be sent.
     */
    protected function _prepareResponse()
    {
        $this->controller->viewBuilder()->setClassName('Rest.Json');

        $this->controller->render();

        return $this->_shutdown();
    }
}
