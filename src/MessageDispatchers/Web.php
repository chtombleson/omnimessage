<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Service\Web as WebService;

class Web extends AbstractDispatcher
{
    private $url;
    private $body;

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
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
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

    public function send()
    {
        $web = new WebService();

        $response = $web->setUrl($this->getUrl())
            ->send($this->getBody());

        return $response;
    }
}