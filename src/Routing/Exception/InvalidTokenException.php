<?php

namespace Rest\Routing\Exception;

use Cake\Core\Exception\Exception;

/**
 * Invalid token exception - used when an authorization token
 * is invalid or blank
 *
 */
class InvalidTokenException extends Exception
{

    // Exception message template
    protected $_messageTemplate = 'Invalid or empty token.';

    // exception code
    protected $_defaultCode = 401;

    /**
     * Constructor.
     *
     * @param string|array $message Either the string of the error message, or an array of attributes
     *   that are made available in the view, and sprintf()'d into Exception::$_messageTemplate
     * @param int $code The code of the error, is also the HTTP status code for the error.
     * @param \Exception|null $previous the previous exception.
     */
    public function __construct($message = null, $code = 401, $previous = null)
    {
        parent::__construct($this->_messageTemplate, $this->_defaultCode, $previous);
    }
}
