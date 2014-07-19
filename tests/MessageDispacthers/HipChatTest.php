<?php
namespace Omnimessage\Tests\MessageDispatchers;

use Omnimessage\MessageDispatchers\HipChat;

class HipChatTest extends \PHPUnit_Framework_TestCase
{
    protected $hipchat;

    public function setUp()
    {
        $this->hipchat = new HipChat();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Omnimessage\\MessageDispatchers\\HipChat', $this->hipchat);
    }

    public function testSetGet()
    {
        $this->hipchat
            ->setToken('token')
            ->setRoom('test')
            ->setColor('yellow')
            ->setNotify(true)
            ->setFormat('text')
            ->setBody('Hello world');

        $this->assertEquals('token', $this->hipchat->getToken());
        $this->assertEquals('test', $this->hipchat->getRoom());
        $this->assertEquals('yellow', $this->hipchat->getColor());
        $this->assertEquals(true, $this->hipchat->getNotify());
        $this->assertEquals('text', $this->hipchat->getFormat());
        $this->assertEquals('Hello world', $this->hipchat->getBody());
    }
}
