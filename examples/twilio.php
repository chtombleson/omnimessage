<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$message_dispatcher = Omnimessage::create('Twilio');

$account_sid = 'account_sid';
$auth_token = 'auth_token';
$from = 'from number';
$to = 'to number';


$msg = $message_dispatcher->setAccountSid($account_sid)
    ->setAuthToken($auth_token)
    ->setFrom($from)
    ->setTo($to)
    ->setBody('Test sms')
    ->send();

if ($msg['sid']) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
