<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$token = 'API Token';
$room  = 'Room';

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
