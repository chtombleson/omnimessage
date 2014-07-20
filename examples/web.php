<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Omnimessage\Omnimessage;

$url = '';
$web = Omnimessage::create('Web');

$status = $web->setUrl($url)
    ->setBody(array(
        'message' => 'hello world',
    ))
    ->send();

if ($status) {
    echo "Message sent\n";
} else {
    echo "Message not sent\n";
}
