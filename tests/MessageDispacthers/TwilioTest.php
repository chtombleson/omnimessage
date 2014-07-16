<?php
namespace Omnimessage\Tests\MessageDispatchers;

use Omnimessage\MessageDispatchers\Twilio;

class TwilioTest extends \PHPUnit_Framework_TestCase
{
    protected $twilio;

    public function setUp()
    {
        $this->twilio = new Twilio();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Omnimessage\\MessageDispatchers\\Twilio', $this->twilio);
    }

    public function testSetGet()
    {
        $this->twilio
            ->setAccountSid('account')
            ->setAuthToken('auth')
            ->setTo('+111111111')
            ->setFrom('+111111111')
            ->setBody('Hello world');

        $this->assertEquals('account', $this->twilio->getAccountSid());
        $this->assertEquals('auth', $this->twilio->getAuthToken());
        $this->assertEquals('+111111111', $this->twilio->getTo());
        $this->assertEquals('+111111111', $this->twilio->getFrom());
        $this->assertEquals('Hello world', $this->twilio->getBody());
    }
}
