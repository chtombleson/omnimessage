<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$url = '';
$web = Omnimessage::create('Web');

$web->setUrl($url)
    ->setBody(array(
        'message' => 'hello world',
    ))
    ->send();

if ($web->isSuccessful()) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
