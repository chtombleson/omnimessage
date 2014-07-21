<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$twilio = Omnimessage::create('Twilio');

$account_sid = 'account_sid';
$auth_token = 'auth_token';
$from = 'from number';
$to = 'to number';


$twilio->setAccountSid($account_sid)
    ->setAuthToken($auth_token)
    ->setFrom($from)
    ->setTo($to)
    ->setBody('Test sms')
    ->send();

if ($twilio->isSuccessful()) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
