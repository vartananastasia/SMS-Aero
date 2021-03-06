<?php

namespace SMS;


use Throwable;


/**
 * for exceptions while constructing request
 * Class SMS_Exception
 * @package SMS
 */
class SMS_Exception extends \Exception
{
    const INCORRECT_TYPE = 1;
    const API_JSON_ERROR = 2;

    public function __construct($code = 0, Throwable $previous = null)
    {
        switch ($code){
            case self::INCORRECT_TYPE:
                $message = "Incorrect type of channel";
                break;
            case self::API_JSON_ERROR:
                $message = "API returned incorrect JSON";
                break;
            default:
                $message = "Unknown SMS_Exception";
                break;
        }
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}