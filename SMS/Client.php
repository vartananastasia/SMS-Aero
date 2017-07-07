<?php

namespace SMS;

use GuzzleHttp\Client as GC;


/**
 * Class Client
 * @package SMS
 */
class Client
{
    private $login;
    private $password;

    # subscription in sms
    const from = 'LEXAND';

    # chanel types
    const TYPE_4 = 4;
    const TYPE_5 = 5;
    const TYPE_6 = 6;
    const TYPE_7 = 7;

    # API settings
    const api_base_url = 'https://gate.smsaero.ru/';
    const send = 'send/';
    const send_to_group = 'sendtogroup/';
    const test_send = 'testsend/';

    # login data
    const LOGIN = 'email@em***';  // Your login in SMS Aero
    const PASSWORD = 'oh***';  // Your password in SMS Aero


    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->login = self::LOGIN;
        self::SetPassword();
    }


    /**
     * sets password in md5
     */
    private function SetPassword()
    {
        $this->password = md5(self::PASSWORD);
    }


    /**
     * sets params in url str
     * @return string
     */
    private function url_params()
    {
        return "?user={$this->login}&password={$this->password}&answer=json";
    }


    /**
     * to send one sms
     * for test sending use $test=True
     * if no type uses default cheapest channel
     * @param SMS $sms
     * @param int $type
     * @param bool $test
     * @throws SMS_API_Exeption
     * @throws SMS_Exeption
     */
    public function send_sms(SMS $sms, $type = self::TYPE_5, $test = False)
    {
        $url = self::api_base_url;
        $url .= ($test) ? self::test_send : self::send;

        switch ($type) {
            case self::TYPE_4:
            case self::TYPE_5:
            case self::TYPE_6:
            case self::TYPE_7:
                $url .= self::url_params() . $sms->url_params() . "&type={$type}";
                $url .= ($test) ? '&from=NEWS' : '&from=' . self::from;
                $client = new GC();
                $response = $client->request('GET', $url);
                $data = self::JsonInAr($response->getBody());

                if($data[1])
                {
                    $result = $data[0]->result;
                    switch ($result)
                    {
                        case 'accepted':
                            break;
                        default:
                            throw new SMS_API_Exeption($data[0]->reason);
                            break;
                    }
                }
                else
                    throw new SMS_Exeption(SMS_Exeption::API_JSON_ERROR);
                break;
            default:
                throw new SMS_Exeption(SMS_Exeption::INCORRECT_TYPE);
                break;
        }
    }



    /**
     * terns json in arr
     * @param $json
     * @return mixed
     */
    public static function JsonInAr($json)
    {
        $data = json_decode($json);
        $error = json_last_error();

        if ($error == JSON_ERROR_NONE)
        {
            return [$data, True];
        }else{
            return [json_last_error_msg(), False];
        }
    }
}