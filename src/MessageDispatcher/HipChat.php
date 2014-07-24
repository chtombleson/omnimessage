<?php
namespace Omnimessage\MessageDispatcher;

use Omnimessage\Exception;
use Omnimessage\Service\HipChat as HipChatService;

/**
 * HipChat message dispatchers
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class HipChat extends AbstractDispatcher
{
    /**
     * @var string
     */
    private $body;

    /**
     * @var GuzzleHttp\Message\Response
     */
    private $response;

    /**
     * @var string
     */
    private $format = 'html';

    /**
     * @var string
     */
    private $color = 'yellow';

    /**
     * @var boolean
     */
    private $notify = false;

    /**
     * @var Omnimessage\Service\HipChat
     */
    private $hipchat_service;

    /**
     * Create a new HipChat message dispatcher
     */
    public function __construct()
    {
        $this->hipchat_service = new HipChatService();
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Get HipChat auth token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->hipchat_service->getToken();
    }

    /**
     * Set HipChat auth token
     *
     * @param string $token
     * @return Omnimessage\MessageDispatcher\HipChat
     */
    public function setToken($token)
    {
        $this->hipchat_service->setToken($token);
        return $this;
    }

    /**
     * Get HipChat room
     *
     * @return string
     */
    public function getRoom()
    {
        return $this->hipchat_service->getRoom();
    }

    /**
     * Set HipChat room
     *
     * @param string $room
     * @return Omnimessage\MessageDispatcher\HipChat
     */
    public function setRoom($room)
    {
        $this->hipchat_service->setRoom($room);
        return $this;
    }

    /**
     * Get HipChat message format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set HipChat message format
     *
     * @param string $format
     * @return Omnimessage\MessageDispatcher\HipChat
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Get HipChat message color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set HipChat message color
     *
     * @param string $color
     * @return Omnimessage\MessageDispatcher\HipChat
     */
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

    /**
     * Get HipChat notify flag
     *
     * @return boolean
     */
    public function getNotify()
    {
        return $this->notify;
    }

    /**
     * Set HipChat notify flag
     *
     * @param boolean $notify
     * @return Omnimessage\MessageDispatcher\HipChat
     */
    public function setNotify($notify)
    {
        $this->notify = $notify;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return ($this->response->getStatusCode() == 204);
    }
}
