<?php
namespace Omnimessage;

/**
 * Send bulk messages easily
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class MultiDispatcher
{
    /**
     * @var array
     */
    private $dispatchers;

    /**
     * @var array
     */
    private $options;

    /**
     * Create a new MultiDispatcher instance
     *
     * @param array $dispatchers
     * @param array $options
     */
    public function __construct($dispatchers, $options)
    {
        if (empty($dispacthers) && empty($options)) {
            throw new Exception(
                'MultiDispatcher constructor required an array of dispatcher and options'
            );
        }

        $this->options = $options;
        $this->setDispatchers($dispatchers);
    }

    /**
     * Get a message dispatcher by name
     *
     * @param string $dispatcher
     * @return Omnimessage\MessageDispatchers\AbstractDispatcher
     */
    public function getDispatcher($dispatcher)
    {
        return isset($this->dispatchers[$dispatcher]) ? $this->dispatchers[$dispatcher] : null;
    }

    /**
     * Set a message dispatcher
     *
     * @param string $dispatcher
     * @param array $options
     * @return Omnimessage\MultiDispatcher
     */
    public function setDispatcher($dispatcher, $options)
    {
        if (!isset($this->dispatchers[$dispatcher])) {
            $dispatcher_instance = Omnimessage::create($dispatcher);
            $dispatcher_instance->set($options);

            $this->dispatchers[$dispatcher] = $dispatcher_instance;
        } else {
            $this->dispatchers[$dispatcher]->set($options);
        }

        return $this;
    }

    /**
     * Send the messages
     *
     * @return array
     */
    public function send()
    {
        $return_vals = array();

        foreach ($this->dispatchers as $name => $dispatcher) {
           $dispatcher->send();
           $return_vals[$name] = $dispatcher->isSuccessful();
        }

        return $return_vals;
    }

    private function setDispatchers($dispatchers)
    {
        foreach ($dispatchers as $dispatcher) {
            if (!isset($this->options[$dispatcher])) {
                throw new Exception(
                    'MultiDispatcher, no dispatcher options for: ' . $dipatcher
                );
            }

            $dispatcher_instance = Omnimessage::create($dispatcher);
            $dispatcher_options = $this->options[$dispatcher];

            $dispatcher_instance->set($dispatcher_options);
            $this->dispatchers[$dispatcher] = $dispatcher_instance;
        }
    }
}
