<?php
namespace Omnimessage\Service;

use GuzzleHttp\Client;

class Twilio
{
    private $account_sid;
    private $auth_token;

    public function getAccountSid()
    {
        return $this->account_sid;
    }

    public function setAccountSid($account_sid)
    {
        $this->account_sid = $account_sid;
        return $this;
    }

    public function getAuthToken()
    {
        return $this->auth_token;
    }

    public function setAuthToken($auth_token)
    {
        $this->auth_token = $auth_token;
        return $this;
    }

    public function send($data)
    {
        if (empty($this->account_sid) && empty($this->auth_token)) {
            throw new Exception('Twilio requires Account SID & Auth Token');
        }

        if (empty($data['from']) && empty($data['to']) && empty($data['body'])) {
            throw new Exception('Twilio send requires from, to & body');
        }

        $twilio_data = array(
            'From'  => $data['from'],
            'To'    => $data['to'],
            'Body'  => $data['body'],
        );

        $api_url  = 'https://api.twilio.com/2010-04-01/Accounts/';
        $api_url .= $this->getAccountSid() . '/SMS/Messages.json';

        $response = $this->sendData($api_url, $twilio_data);
        $json = $response->json();

        if (in_array($json['status'], array(400, 401, 404))) {
            throw new Exception('Twilio error: ' . $json['detail']);
        }

        return $response;
    }

    private function sendData($url, $data)
    {
        $client = new Client();
        $response = $client->post(
            $url,
            array(
                'body' => $data,
                'auth' => array(
                    $this->getAccountSid(),
                    $this->getAuthToken(),
                ),
            )
        );

        return $response;
    }
}
