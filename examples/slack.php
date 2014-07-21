<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$slack = Omnimessage::create('Slack');

$token = 'token';
$channel = 'channel';
$username = 'username';
$team = 'team';

$slack->setToken($token)
    ->setTeam($team)
    ->setChannel($channel)
    ->setUsername($username)
    ->setBody('Test sms')
    ->send();

if ($slack->isSuccessful()) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
