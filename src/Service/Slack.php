<?php
namespace Omnimessage\Service;

use GuzzleHttp\Client;

class Slack
{
    private $token;

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function send($data)
    {
        if (empty($this->token)) {
            throw new Exception('Slack requires token');
        }

        if (empty($data['team']) && empty($data['username']) && empty($data['body']) && empty($data['channel'])) {
            throw new Exception('Slack send requires team, username, body & channel');
        }

        $api_url  = 'https://' . $data['team'] . '.slack.com/services/hooks/';
        $api_url .= 'incoming-webhook?token=' . $this->getToken();

        $slack_data = array(
            'payload' => json_encode(array(
                'text'      => $data['body'],
                'username'  => $data['username'],
                'channel'   => $data['channel'],
            )),
        );

        $response = $this->sendData($api_url, $slack_data);

        if ($response != 200) {
            throw new Exception('Slack POST error');
        }

        return true;
    }

    private function sendData($url, $data)
    {
        $client = new Client();
        $response = $client->post(
            $url,
            array(
                'body' => $data,
            )
        );

        return $response->getStatusCode();
    }
}
