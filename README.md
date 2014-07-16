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

### Email Example


    <?php
    require_once(__DIR__ . '/vendor/autoload.php');

    use Omnimessage\Omnimessage;

    $message_dispatcher = Omnimessage::create('Email');

    // Set smtp transport
    $message_dispatcher->setTransport('smtp', array(
        'host' => 'localhost',
        'port' => 25,
    ));

    // Set mail transport (PHP mail)
    $message_dispatcher->setTransport('mail');

    // Set send mail transport (Default send mail command is: /usr/sbin/sendmail -bs)
    $message_dispatcher->setTransport('send_mail');

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


### Twilio Example


    <?php
    require_once(__DIR__ . '/vendor/autoload.php');

    use Omnimessage\Omnimessage;

    $message_dispatcher = Omnimessage::create('Twilio');

    $msg = $message_dispatcher->setAccountSid('{{ account_sid }}')
        ->setAuthToken('{{ auth_token }}')
        ->setFrom('+15005550006')
        ->setTo('+15005550006')
        ->setBody('Test sms')
        ->send();

    if ($msg['sid']) {
        echo "Message sent\n";
    } else {
        echo "Message not sent\n";
    }


### Slack Example


    <?php
    require_once(__DIR__ . '/vendor/autoload.php');

    use Omnimessage\Omnimessage;

    $message_dispatcher = Omnimessage::create('Slack');

    $msg = $message_dispatcher->setToken('{{ token }}')
        ->setTeam('test')
        ->setChannel('test')
        ->setUsername('test')
        ->setBody('Test sms')
        ->send();

    if ($msg['ok']) {
        echo "Message sent\n";
    } else {
        echo "Message not sent\n";
    }


## Tests

Test use phpunit, they can be run using the `phpunit` command in the root directory.

## License

See LICENSE
