<?php

namespace SMS;


use Throwable;


/**
 * for exceptions from API after response
 * Class SMS_API_Exception
 * @package SMS
 */
class SMS_API_Exception extends \Exception
{

    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}