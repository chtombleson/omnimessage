<?php
namespace Omnimessage\MessageDispatchers;

abstract class AbstractDispatcher
{
    abstract public function getBody();
    abstract public function setBody($body);
    abstract public function send();

    public function getName()
    {
        return end(explode('\\', __CLASS__));
    }
}
