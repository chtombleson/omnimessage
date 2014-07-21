<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$email = Omnimessage::create('Email');

// Set smtp transport
$email->setTransport('smtp', array(
    'host' => 'localhost',
    'port' => 25,
));

// Set mail transport (PHP mail)
// $email->setTransport('mail');

// Set send mail transport (Default send mail command is: /usr/sbin/sendmail -bs)
// $email->setTransport('send_mail');

// Create the message
$email->setSubject('Test message')
    ->setFrom('test@example.com')
    ->setTo('test1@example.com')
    ->setReplyTo('no-reply@example.com')
    ->setBody('This is a test message')
    ->send();

if ($email->isSuccessful()) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
