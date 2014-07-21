<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Service\Web as WebService;

class Web extends AbstractDispatcher
{
    private $body;
    private $response;
    private $web_service;

    public function __construct()
    {
        $this->web_service = new WebService();
    }

    public function get()
    {
        return array(
            'url'  => $this->getUrl(),
            'body' => $this->getBody(),
        );
    }

    public function set($properties)
    {
        if (!empty($properties['url'])) {
            $this->setUrl($properties['url']);
        }

        if (!empty($properties['body'])) {
            $this->setBody($properties['body']);
        }

        return $this;
    }

    public function getUrl()
    {
        return $this->web_service->getUrl();
    }

    public function setUrl($url)
    {
        $this->web_service->setUrl($url);
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
        $web = new WebService();

        $response = $this->web_service->send($this->getBody());

        $this->response = $response;
        return $this;
    }

    public function isSuccessful()
    {
        return ($this->response->getStatusCode() == 200);
    }
}
