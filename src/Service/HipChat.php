<?php
namespace Omnimessage\Service;

use GuzzleHttp\Client;

class HipChat
{
    private $token;
    private $room;

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

    public function send($data)
    {
        if (empty($this->token) && empty($this->room)) {
            throw new Exception('HipChat requires Token & Room to be set');
        }

        if (empty($data['color']) && empty($data['notify']) && empty($data['body']) && empty($data['format'])) {
            throw new Exception('HipChat send requires color, notify, format & body');
        }

        $hipchat_data = array(
            'color'           => $data['color'],
            'notify'          => $data['notify'],
            'message'         => $data['body'],
            'message_format'  => $data['format'],
        );

        $api_url  = 'https://api.hipchat.com/v2/room/' . $this->getRoom() . '/notification';
        $api_url .= '?auth_token=' . $this->getToken();

        $response = $this->sendData($api_url, $hipchat_data);

        if ($response->getStatusCode() != 204) {
            throw new Exception('HipChat returned http code: ' . $response->getStatusCode());
        }

        return $repsonse;
    }

    private function sendData($url, $data)
    {
        $client = new Client();
        $response = $client->post(
            $url,
            array(
                'headers' => array(
                    'Content-Type' => 'application/json',
                    'Content-Length' => strlen(json_encode($data)),
                ),
                'body' => json_encode($data),
            )
        );

        return $response;
    }
}
