<?php
namespace Omnimessage\Tests\MessageDispatcher;

use Omnimessage\MessageDispatcher\Web;

class WebTest extends \PHPUnit_Framework_TestCase
{
    protected $web;

    public function setUp()
    {
        $this->web = new Web();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Omnimessage\\MessageDispatcher\\Web', $this->web);
    }

    public function testSetGet()
    {
        $this->web
            ->setUrl('url')
            ->setBody(array(
                'hello' => 'world',
            ));

        $this->assertEquals('url', $this->web->getUrl());
        $this->assertEquals(array('hello' => 'world'), $this->web->getBody());
    }
}
