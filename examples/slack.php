<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$message_dispatcher = Omnimessage::create('Slack');

$token = 'token';
$channel = 'channel';
$username = 'username';
$team = 'test';

$msg = $message_dispatcher->setToken($token)
    ->setTeam($team)
    ->setChannel($channel)
    ->setUsername($username)
    ->setBody('Test sms')
    ->send();

if ($msg['ok']) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
