# Getting started with Omnimessage

Omnimessage provides a consistent interface for sending messages
whether it be via email or another service such as slack or twilio.

## Installation

Omnimessage can be installed via [composer](http://getcomposer.org)

Add the following to your composer.json file

    "require": {
            "chtombleson\omnimessage": "~0.1"
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

Create a new instance of a dispatcher.

Parameter: string message_dispatcher, type of message dispatcher you want (Email etc)

Return: Omnimessage\MessageDispatcher\AbstractDispatcher, message dispacther object

### Omnimessage::createMulti(array $dispatchers, array $options)

Create a new instance of the MultiDispatcher.

Parameter: array dispacthers, array of message dispatchers you want to create

Parameter: array options, array of dispatcher options

Return: Omnimessage\MultiDispatcher

### Omnimessage::getMessageDispatchers()

Get an array of all available message dispatchers.

Return: array, array of available message dispatchers

## Omnimessage\MultiDispatcher API

Omnimessage\MultiDispatcher allows you to send a message via
different message dispatchers easily.

### Documentation

  * [MultiDispatcher](https://github.com/chtombleson/omnimessage/blob/master/docs/multidispatcher.md)

### Example useage

    <?php
    require_once(__DIR__ . '/vendor/autoload.php');

    use Omnimessage\Omnimessage;

    // Create a MultiDispatcher instance
    // With email and slack dispatcher
    $multi = Omnimessage::createMulti(
        array('Email', 'Slack'), // Use Email and Slack dispatchers
        array(
            // Email options
            'Email' => array(
                'body'  => 'test email',
                'to'    => 'test@example.com',
                'from'  => 'no-reply@example.com',
                'subject' => 'Multi dispatcher test',
                'transport' => array(
                    'type' => 'smtp',
                    'options' => array(
                        'host' => 'localhost',
                        'port' => 25,
                    ),
                ),
            ),
            // Slack options
            'Slack' => array(
                'body'      => 'test slack',
                'username'  => 'slack-bot',
                'channel'   => 'test',
                'team'      => 'test',
                'token'     => 'api token',
            ),
        )
    );

    // Send the messages
    $multi->send();


## Omnimessage\MessageDispatchers API

  * [Email](https://github.com/chtombleson/omnimessage/blob/master/docs/email.md)
  * [Twilio](https://github.com/chtombleson/omnimessage/blob/master/docs/twilio.md)
  * [Slack](https://github.com/chtombleson/omnimessage/blob/master/docs/slack.md)
  * [HipChat](https://github.com/chtombleson/omnimessage/blob/master/docs/hipchat.md)
  * [Web](https://github.com/chtombleson/omnimessage/blob/master/docs/web.md)

## Creating a message dispatcher

All message dispatchers must extend Omnimessage\MessageDispatcher\AbstractDispatcher
and implement the following methods.

  * get()
  * set(array $properties)
  * getBody()
  * setBody(string $body)
  * getResponse()
  * send()
  * isSuccessful()

