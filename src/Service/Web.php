<?php
namespace Omnimessage\Service;

use GuzzleHttp\Client;

/**
 * Web hook service client
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class Web extends AbstractService
{
    /**
     * @var string
     */
    private $url;

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Omnimessage\Service\Web
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Send message to the url
     *
     * @param array $data
     * @return GuzzleHttp\Message\Response
     */
    public function send($data)
    {
        if (empty($this->url)) {
            throw new Exception('Web dispatcher requires a url');
        }

        $response = $this->sendData($data);
        return $response;
    }

    private function sendData($data)
    {
        $client = new Client();
        $response = $client->post(
            $this->getUrl(),
            array(
                'headers' => array(
                    'Content-Type' => 'application/json',
                ),
                'body' => json_encode($data),
            )
        );

        return $response;
    }
}
