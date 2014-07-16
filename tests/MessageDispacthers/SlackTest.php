<?php
namespace Omnimessage\Tests\MessageDispatchers;

use Omnimessage\MessageDispatchers\Slack;

class SlackTest extends \PHPUnit_Framework_TestCase
{
    protected $slack;

    public function setUp()
    {
        $this->slack = new Slack();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Omnimessage\\MessageDispatchers\\Slack', $this->slack);
    }

    public function testSetGet()
    {
        $this->slack
            ->setToken('token')
            ->setTeam('team')
            ->setUsername('test')
            ->setChannel('test')
            ->setBody('Hello world');

        $this->assertEquals('token', $this->slack->getToken());
        $this->assertEquals('team', $this->slack->getTeam());
        $this->assertEquals('test', $this->slack->getUsername());
        $this->assertEquals('test', $this->slack->getChannel());
        $this->assertEquals('Hello world', $this->slack->getBody());
    }
}
