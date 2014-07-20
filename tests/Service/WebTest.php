<?php
namespace Omnimessage\Tests\Service;

use Omnimessage\Service\Web;

class WebTest extends \PHPUnit_Framework_TestCase
{
    protected $web;

    public function setUp()
    {
        $this->web = new Web();
    }

    public function testService()
    {
        $this->web
            ->setUrl('url');

        $this->assertInstanceOf('Omnimessage\\Service\\Web', $this->web);
        $this->assertEquals('url', $this->web->getUrl());
    }
}
