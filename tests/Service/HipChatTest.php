<?php
namespace Omnimessage\Tests\Service;

use Omnimessage\Service\HipChat;

class HipChatTest extends \PHPUnit_Framework_TestCase
{
    protected $hipchat;

    public function setUp()
    {
        $this->hipchat = new HipChat();
    }

    public function testService()
    {
        $this->hipchat
            ->setToken('token')
            ->setRoom('room');

        $this->assertInstanceOf('Omnimessage\\Service\\HipChat', $this->hipchat);
        $this->assertEquals('token', $this->hipchat->getToken());
        $this->assertEquals('room', $this->hipchat->getRoom());
    }
}
