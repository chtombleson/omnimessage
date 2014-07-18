<?php
namespace Omnimessage\Service;

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

        $response = $this->sendData($api_url, json_encode($hipchat_data));

        if ($response != 204) {
            throw new Exception('HipChat returned http code: ' . $response);
        }

        return true;
    }

    private function sendData($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
        ));

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            throw new Exception('HipChat curl error: ' . curl_error($ch));
        }

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $status;
    }
}
