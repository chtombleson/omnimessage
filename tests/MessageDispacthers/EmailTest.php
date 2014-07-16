<?php
use Omnimessage\MessageDispatchers\Email;

class EmailTest extends PHPUnit_Framework_TestCase
{
    protected $email;

    public function setUp()
    {
        $this->email = new Email();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Omnimessage\\MessageDispatchers\\Email', $this->email);
    }

    public function testSetGet()
    {
        $this->email
            ->setSubject('hello')
            ->setTo('hello@example.com')
            ->setFrom('hello1@example.com')
            ->setReplyTo('no-reply@example.com')
            ->setTransport('mail')
            ->setContentType('text/html')
            ->setBody('Hello world');

        $this->assertEquals('hello', $this->email->getSubject());
        $this->assertEquals(array('hello@example.com' => null), $this->email->getTo());
        $this->assertEquals(array('hello1@example.com' => null), $this->email->getFrom());
        $this->assertEquals(array('no-reply@example.com' => null), $this->email->getReplyTo());
        $this->assertInstanceOf('\\Swift_MailTransport', $this->email->getTransport());
        $this->assertEquals('text/html', $this->email->getContentType());
        $this->assertEquals('Hello world', $this->email->getBody());

        $this->email->setTransport('smtp', array(
            'host' => 'localhost',
            'port' => 25,
        ));
        $this->assertInstanceOf('\\Swift_SmtpTransport', $this->email->getTransport());

        $this->email->setTransport('send_mail');
        $this->assertInstanceOf('\\Swift_SendmailTransport', $this->email->getTransport());
    }
}
