<?php
namespace Omnimessage\MessageDispatchers;

abstract class AbstractDispatcher
{
    abstract public function send($message);

    public function getName()
    {
        return end(explode('\\', __CLASS__));
    }
}
