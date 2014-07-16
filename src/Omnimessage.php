<?php
namespace Omnimessage;

use Symfony\Component\Finder\Finder;

class Omnimessage
{
    public static function create($message_dispatcher)
    {
        $class = 'Omnimessage\\MessageDispatchers\\' . $message_dispatcher;

        if (class_exists($class)) {
            return new $class();
        } else {
            throw new Exception(
                'Message Dispatcher: ' . $message_dispather . ' does not exist'
            );
        }
    }

    public static function getMessageDispatchers()
    {
        $finder = new Finder();
        $dispatchers = $finder->files()->name('*.php')
            ->in(__DIR__ . '/MessageDispatchers');

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
