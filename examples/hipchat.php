<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$token = 'token';
$room  = 'room';

$hipchat = Omnimessage::create('HipChat');

$sent = $hipchat->setToken($token)
    ->setRoom($room)
    ->setBody('hello world')
    ->send();

if ($sent) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
