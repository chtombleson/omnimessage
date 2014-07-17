<?php
namespace Omnimessage\Service;

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

        if (in_array($response['status'], array(400, 401, 404))) {
            throw new Exception('Twilio error: ' . $response['detail']);
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
        curl_setopt($ch, CURLOPT_USERPWD, $this->getAccountSid() . ':' . $this->getAuthToken());

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            throw new Exception('Twilio curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
