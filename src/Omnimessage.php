<?php
namespace Omnimessage;

use Symfony\Component\Finder\Finder;

/**
 * Core class used to create message dispatchers
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class Omnimessage
{
    /**
     * Create a message dispatcher
     *
     * @param string $message_dispatcher
     * @return Omnimessage\MessageDispatcher\AbstractDispatcher
     */
    public static function create($message_dispatcher)
    {
        if (!in_array($message_dispatcher, self::getMessageDispatchers())) {
            throw new Exception(
                'Message Dispatcher: ' . $message_dispather . ' does not exist'
            );
        }

        $class = 'Omnimessage\\MessageDispatcher\\' . $message_dispatcher;

        if (class_exists($class)) {
            return new $class();
        } else {
            throw new Exception(
                'Message Dispatcher: ' . $message_dispatcher . ' does not exist'
            );
        }
    }

    /**
     * Create a multi message dispatcher
     *
     * @param array $message_dispatchers
     * @param array $options
     * @return Omnimessage\MultiDispatcher
     */
    public static function createMulti($message_dispatchers, $options)
    {
        return new MultiDispatcher($message_dispatchers, $options);
    }

    /**
     * Get names of all message dispatchers
     *
     * @return array
     */
    public static function getMessageDispatchers()
    {
        $finder = new Finder();
        $dispatchers = $finder->files()->name('*.php')
            ->in(__DIR__ . '/MessageDispatcher');

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
