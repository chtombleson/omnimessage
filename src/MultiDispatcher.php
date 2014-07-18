<?php
namespace Omnimessage;

class MultiDispatcher
{
    private $dispatchers;
    private $options;

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

    public function getDispatcher($dispatcher)
    {
        return isset($this->dispatchers[$dispatcher]) ? $this->dispatchers[$dispatcher] : null;
    }

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

    public function send()
    {
        $return_vals = array();

        foreach ($this->dispatchers as $name => $dispatcher) {
           $return_vals[$name] = $dispatcher->send();
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
