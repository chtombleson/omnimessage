<?php
namespace Omnimessage;

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
}
