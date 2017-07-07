<?php

namespace SMS;


/**
 * Class SMS
 * @package SMS
 */
class SMS
{
    private $body;  // sms text
    private $number;  // user number

    const TEST_NUMBER = '79000000000';  // Insert number for tests


    /**
     * SMS constructor.
     * @param string $body
     * @param string $number
     */
    public function __construct($body = 'test', $number = self::TEST_NUMBER)
    {
        $this->body = $body;
        $this->number = preg_replace("/[^0-9]/", '', $number);;
    }


    /**
     * sets params in url str
     * @return string
     */
    public function url_params()
    {
        return "&to={$this->number}&text={$this->body}";
    }
}