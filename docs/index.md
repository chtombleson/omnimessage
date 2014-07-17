# Getting started with Omnimessage

Omnimessage provides a consistent interface for sending messages
whether it be via email or another service such as slack or twilio.

## Installation

Omnimessage can be installed via [composer](http://getcomposer.org)

Add the following to your composer.json file

    "require": {
            "chtombleson\omnimessage": "dev-master"
    }

Then run `composer update`

## Using Omnimessage

Using Omnimessage is pretty straight forward, see example below.

    <?php
    require_once(__DIR__ . '/vendor/autoload.php');

    use Omnimessage\Omnimessage;

    // Create a new message dispatcher
    $email = Omnimessage::create('Email');

## Omnimessage API

### Omnimessage::create(string $message_dispatcher)

Parameter: string message_dispatcher, type of message dispatcher you want (Email etc)

Return: Omnimessage\MessageDispatchers, message dispacther object

### Omnimessage::getMessageDispatchers()

Return: array, array of available message dispatchers

## Omnimessage\MessageDispatchers API

  * [Email](https://github.com/chtombleson/omnimessage/blob/master/docs/email.md)
  * [Twilio](https://github.com/chtombleson/omnimessage/blob/master/docs/twilio.md)
  * [Slack](https://github.com/chtombleson/omnimessage/blob/master/docs/slack.md)

## Creating a message dispatcher

All message dispatchers must extend Omnimessage\MessageDispatchers\AbstractDispatcher
and implement the following methods.

  * getBody()
  * setBody(string $body)
  * send()

