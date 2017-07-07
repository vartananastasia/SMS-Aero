<?php

namespace SMS;


class SMS
{
    private $body;
    private $number;

    const TEST_NUMBER = '79000000000';  // Number for tests


    public function __construct($body = 'test', $number = self::TEST_NUMBER)
    {
        $this->body = $body;
        $this->number = preg_replace("/[^0-9]/", '', $number);;
    }


    public function url_params()
    {
        return "&to={$this->number}&text={$this->body}";
    }
}