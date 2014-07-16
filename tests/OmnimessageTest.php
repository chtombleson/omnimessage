<?php
namespace Omnimessage\Tests;

use Omnimessage\Omnimessage;
use Symfony\Component\Finder\Finder;

class OmnimessageTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $dispatchers = $this->getMessageDispatchers();

        foreach ($dispatchers as $dispatcher) {
            $class = 'Omnimessage\\MessageDispatchers\\' . $dispatcher;
            $omni = Omnimessage::create($dispatcher);
            $this->assertInstanceOf($class, $omni);
        }
    }

    public function testGetMessageDispatchers()
    {
        $message_dispatchers = Omnimessage::getMessageDispatchers();
        $this->assertEquals($this->getMessageDispatchers(), $message_dispatchers);
    }

    private function getMessageDispatchers()
    {
        $finder = new Finder();
        $dispatchers = $finder->files()->name('*.php')
            ->in(dirname(__DIR__) . '/src/MessageDispatchers');

        $available_dispatchers = array();

        foreach ($dispatchers as $dispatcher) {
            $name = basename($dispatcher->getFilename(), '.php');

            if ($name != 'AbstractDispatcher') {
                $available_dispatchers[] = $name;
            }
        }

        return $available_dispatchers;
    }
}
