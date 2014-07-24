<?php
namespace Omnimessage\MessageDispatcher;

/**
 * Base class for all message dispatchers
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
abstract class AbstractDispatcher
{
    /**
     * Get the dispatchers properties
     *
     * @return array
     */
    abstract public function get();

    /**
     * Set dispatchers properties
     *
     * @param array $properties
     * @return Omnimessage\MessageDispatcher\AbstractDispatcher
     */
    abstract public function set($properties);

    /**
     * Get the message body
     *
     * @return mixed
     */
    abstract public function getBody();

    /**
     * Set message body
     *
     * @param mixed $body
     * @return Omnimessage\MessageDispatcher\AbstractDispatcher
     */
    abstract public function setBody($body);

    /**
     * Get response from dispatcher
     *
     * @return mixed
     */
    abstract public function getResponse();

    /**
     * Send the message
     *
     * @return Omnimessage\MessageDispatcher\AbstractDispatcher
     */
    abstract public function send();

    /**
     * Check if message was successfully sent
     *
     * @return boolean
     */
    abstract public function isSuccessful();

    /**
     * Get the dispatcher name
     *
     * @return string
     */
    public function getName()
    {
        return end(explode('\\', __CLASS__));
    }
}
