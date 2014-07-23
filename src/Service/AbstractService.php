<?php
namespace Omnimessage\Service;

/**
 * Base class for all Services
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
abstract class AbstractService
{
    /**
     * Send a message via the service
     *
     * @param array $data
     * @return mixed
     */
    abstract public function send($data);
}
