<?php
namespace Omnimessage;

use Symfony\Component\Finder\Finder;

class Omnimessage
{
    public static function create($message_dispatcher)
    {
        if (!in_array($message_dispatcher, self::getMessageDispatchers())) {
            throw new Exception(
                'Message Dispatcher: ' . $message_dispather . ' does not exist'
            );
        }

        $class = 'Omnimessage\\MessageDispatchers\\' . $message_dispatcher;

        if (class_exists($class)) {
            return new $class();
        } else {
            throw new Exception(
                'Message Dispatcher: ' . $message_dispather . ' does not exist'
            );
        }
    }

    public static function createMulti($message_dispatchers, $options)
    {
        $message_dispatchers = array_filter($message_dispatchers, function($dispatcher) {
            return in_array($dispatcher, self::getMessageDispatchers());
        });

        return new MultiDispatcher($message_dispatchers, $options);
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
