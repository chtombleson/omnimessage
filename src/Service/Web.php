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

        if ($response != 200) {
            return false;
        }

        return true;
    }

    private function sendData($data)
    {
        $client = new Client();
        $reponse = $client->post(
            $this->getUrl(),
            array(
                'headers' => array(
                    'Content-Type' => 'application/json',
                ),
                'body' => json_encode($data),
            )
        );

        return $response->getStatusCode();
    }
}
