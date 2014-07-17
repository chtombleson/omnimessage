<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$message_dispatcher = Omnimessage::create('Email');

// Set smtp transport
$message_dispatcher->setTransport('smtp', array(
    'host' => 'localhost',
    'port' => 25,
));

// Set mail transport (PHP mail)
// $message_dispatcher->setTransport('mail');

// Set send mail transport (Default send mail command is: /usr/sbin/sendmail -bs)
// $message_dispatcher->setTransport('send_mail');

// Create the message
$message_dispatcher->setSubject('Test message')
    ->setFrom('test@example.com')
    ->setTo('test1@example.com')
    ->setReplyTo('no-reply@example.com')
    ->setBody('This is a test message')
    ->send();

if ($message_dispatcher) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
