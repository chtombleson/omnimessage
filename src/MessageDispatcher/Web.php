<?php
namespace Omnimessage\MessageDispatcher;

use Omnimessage\Service\Web as WebService;

/**
 * Web message dispatchers
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class Web extends AbstractDispatcher
{
    /**
     * @var array
     */
    private $body;

    /**
     * @var GuzzleHttp\Message\Response
     */
    private $response;

    /**
     * @var Omnimessage\Service\Web
     */
    private $web_service;

    /**
     * Create a new Web message dispatcher
     */
    public function __construct()
    {
        $this->web_service = new WebService();
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return array(
            'url'  => $this->getUrl(),
            'body' => $this->getBody(),
        );
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->web_service->getUrl();
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Omnimessage\MessageDispatcher\Web
     */
    public function setUrl($url)
    {
        $this->web_service->setUrl($url);
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
        $web = new WebService();

        $response = $this->web_service->send($this->getBody());

        $this->response = $response;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return ($this->response->getStatusCode() == 200);
    }
}
