# Omnimessage

A simple to use PHP multi-message dispatcher. This project is currently
under active development and is not yet stable.

## Documentation

Omnimessage documentation.

### Installation

Install via composer, add the following to your composer.json.

    "require": {
        "chtombleson\omnimessage": "dev-master"
    }

Run `composer install`

### Usage

Example of sending an email.

    <?php
    require_once(__DIR__ . '/vendor/autoload.php');

    use Omnimessage\Omnimessage;

    $message_dispatcher = Omnimessage::create('Email');

    // Create your mail transport object
    $transport = \Swift_SmtpTransport::newInstance('localhost', 25);
    $message_dispatcher->setTransport($transport);

    // Create the message
    $message_dispatcher->setSubject('Test message')
        ->setFrom(array('test@example.com'))
        ->setTo(array('test1@example.com'))
        ->setReplyTo('no-reply@example.com')
        ->send('This is a test message.');

    if ($message_dispatcher) {
        echo "Message sent";
    } else {
        echo "Message no sent";
    }

## License

See LICENSE
