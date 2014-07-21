<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Exception;
use Omnimessage\Service\HipChat as HipChatService;

class HipChat extends AbstractDispatcher
{
    private $token;
    private $room;
    private $body;
    private $response;
    private $format = 'html';
    private $color = 'yellow';
    private $notify = false;

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
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function setRoom($room)
    {
        $this->room = $room;
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

        $hipchat = new HipChatService();
        $response = $hipchat->setToken($this->getToken())
            ->setRoom($this->getRoom())
            ->send(array(
                'body'   => $this->getBody(),
                'color'  => $this->getColor(),
                'notify' => $this->getNotify(),
                'format' => $this->getFormat(),
            ));

        $this->response = $response;
        return $this;
    }

    public function isSuccessful()
    {
        return ($this->response->getStatusCode() == 204);
    }
}
