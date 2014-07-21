<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Exception;
use Omnimessage\Service\HipChat as HipChatService;

class HipChat extends AbstractDispatcher
{
    private $body;
    private $response;
    private $format = 'html';
    private $color = 'yellow';
    private $notify = false;
    private $hipchat_service;

    public function __construct()
    {
        $this->hipchat_service = new HipChatService();
    }

    public function get()
    {
        return array(
            'body'          => $this->getBody(),
            'token'         => $this->getToken(),
            'room'          => $this->getRoom(),
            'format'        => $this->getFormat(),
            'color'         => $this->getColor(),
            'notify'        => $this->getNotify(),
        );
    }

    public function set($properties)
    {
        if (!empty($properties['body'])) {
            $this->setBody($properties['body']);
        }

        if (!empty($properties['token'])) {
            $this->setToken($properties['token']);
        }

        if (!empty($properties['room'])) {
            $this->setRoom($properties['room']);
        }

        if (!empty($properties['format'])) {
            $this->setFormat($properties['format']);
        }

        if (!empty($properties['color'])) {
            $this->setColor($properties['color']);
        }

        if (isset($properties['notify'])) {
            $this->setNotify($properties['notify']);
        }

        return $this;
    }


    public function getToken()
    {
        return $this->hipchat_service->getToken();
    }

    public function setToken($token)
    {
        $this->hipchat_service->setToken($token);
        return $this;
    }

    public function getRoom()
    {
        return $this->hipchat_service->getRoom();
    }

    public function setRoom($room)
    {
        $this->hipchat_service->setRoom($room);
        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $colors = array('yellow', 'red', 'green', 'purple', 'gray', 'random');

        if (!in_array($color, $colors)) {
            throw new Exception(
                'HipChat color can only be one of the following: ' . join(', ', $colors)
            );
        }

        $this->color = $color;
        return $this;
    }

    public function getNotify()
    {
        return $this->notify;
    }

    public function setNotify($notify)
    {
        $this->notify = $notify;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function send()
    {
        if (empty($this->body)) {
            throw new Exception('HipChat dispatcher requires the Body to be set');
        }

        if (empty($this->token) || empty($this->room)) {
            throw new Exception('HipChat dispatcher requires Token & Room to be set');
        }

        $response = $this->hipchat_service->send(
            array(
                'body'   => $this->getBody(),
                'color'  => $this->getColor(),
                'notify' => $this->getNotify(),
                'format' => $this->getFormat(),
            )
        );

        $this->response = $response;
        return $this;
    }

    public function isSuccessful()
    {
        return ($this->response->getStatusCode() == 204);
    }
}
