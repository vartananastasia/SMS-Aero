# SMS-Aero

Uses:

``GuzzleHttp/6.2.1`` - http://docs.guzzlephp.org/en/stable/overview.html#installation
``curl/7.51.0`` 
``PHP/5.6.29``

Change:

in ``SMS\Client.php``:

```php
    # login data
    const LOGIN = 'email@em***';  // Your login in SMS Aero
    const PASSWORD = 'oh***';  // Your password in SMS Aero
```

in ``SMS\SMS.php``:

```php
    const TEST_NUMBER = '79000000000';  // Insert number for tests
```
 
Use real:

```php
$send = new \SMS\Client();
$sms = new SMS\SMS('text', '89***');
$send->send_sms($sms);
```
 
Use test:

```php
$send = new \SMS\Client();
$sms = new SMS\SMS();
$send->send_sms($sms, \SMS\Client::TYPE_5, True);
```