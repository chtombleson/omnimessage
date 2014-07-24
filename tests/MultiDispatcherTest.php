<?php
namespace Omnimessage\Tests;

use Omnimessage\MultiDispatcher;

class MultiDispatcherTest extends \PHPUnit_Framework_TestCase
{
    protected $multi;
    protected $email = array(
        'body'      => 'test',
        'subject'   => 'test',
        'from'      => array('test@example.com' => null),
        'to'        => array('testing@example.com' => null),
        'transport' => array(
            'type'    => 'smtp',
            'options' => array(
                'host' => 'localhost',
                'port' => 25,
            ),
        ),
    );

    public function setUp()
    {
        $this->multi = new MultiDispatcher(
            array('Email'),
            array(
                'Email' => $this->email,
            )
        );
    }

    public function testGetSet()
    {
        $email = $this->multi->getDispatcher('Email');
        $this->assertInstanceOf('Omnimessage\\MessageDispatcher\\Email', $email);

        $options = $email->get();
        foreach ($options as $idx => $val) {
            if (isset($this->email[$idx]) && $idx != 'transport' && $idx != 'message') {
                $this->assertEquals($this->email[$idx], $val);
            }
        }

        $this->multi->setDispatcher('Email', array_merge($options, array(
            'reply_to' => array('no-reply@example.com' => null),
            'content_type' => 'text/html',
        )));

        $this->email['reply_to'] = array('no-reply@example.com' => null);
        $this->email['content_type'] = 'text/html';

        $options = $this->multi->getDispatcher('Email')->get();
        foreach ($options as $idx => $val) {
            if (isset($this->email[$idx]) && $idx != 'transport' && $idx != 'message') {
                $this->assertEquals($this->email[$idx], $val);
            }
        }
    }
}
