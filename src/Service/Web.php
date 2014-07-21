<?php
namespace Omnimessage\Service;

use GuzzleHttp\Client;

class Web
{
    private $url;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

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
