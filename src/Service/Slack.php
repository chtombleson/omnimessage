<?php
namespace Omnimessage\Service;

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

        if (!$response['ok']) {
            throw new Exception('Slack error: ' . $response['error']);
        }

        return $response;
    }

    private function sendData($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (!empty(curl_error($ch))) {
            throw new Exception('Slack curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
