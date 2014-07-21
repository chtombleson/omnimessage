<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$token = 'token';
$room  = 'room';

$hipchat = Omnimessage::create('HipChat');

$hipchat->setToken($token)
    ->setRoom($room)
    ->setBody('hello world')
    ->send();

if ($hipchat->isSuccessful()) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
