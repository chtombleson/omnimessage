<?php
namespace Omnimessage\Tests\Service;

use Omnimessage\Service\Slack;

class SlackTest extends \PHPUnit_Framework_TestCase
{
    protected $slack;

    public function setUp()
    {
        $this->slack = new Slack();
    }

    public function testService()
    {
        $this->slack
            ->setToken('token');

        $this->assertInstanceOf('Omnimessage\\Service\\Slack', $this->slack);
        $this->assertEquals('token', $this->slack->getToken());
    }
}
