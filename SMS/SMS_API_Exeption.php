<?php

namespace SMS;


use Throwable;


/**
 * for exeptions from API after response
 * Class SMS_API_Exeption
 * @package SMS
 */
class SMS_API_Exeption extends \Exception
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