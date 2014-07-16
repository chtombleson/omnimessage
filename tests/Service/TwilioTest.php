<?php
namespace Omnimessage\Tests\Service;

use Omnimessage\Service\Twilio;

class TwilioTest extends \PHPUnit_Framework_TestCase
{
    protected $twilio;

    public function setUp()
    {
        $this->twilio = new Twilio();
    }

    public function testService()
    {
        $this->twilio
            ->setAccountSid('account')
            ->setAuthToken('auth');

        $this->assertInstanceOf('Omnimessage\\Service\\Twilio', $this->twilio);
        $this->assertEquals('account', $this->twilio->getAccountSid());
        $this->assertEquals('auth', $this->twilio->getAuthToken());
    }
}
