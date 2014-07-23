<?php
namespace Omnimessage\Service;

use GuzzleHttp\Client;

/**
 * Twilio web service client
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class Twilio extends AbstractService
{
    /**
     * @var string
     */
    private $account_sid;

    /**
     * @var string
     */
    private $auth_token;

    /**
     * Get Twilio account sid
     *
     * @return string
     */
    public function getAccountSid()
    {
        return $this->account_sid;
    }

    /**
     * Set Twilio account sid
     *
     * @param string $account_sid
     * @return Omnimessage\Service\Twilio
     */
    public function setAccountSid($account_sid)
    {
        $this->account_sid = $account_sid;
        return $this;
    }

    /**
     * Get Twilio auth token
     *
     * @return string
     */
    public function getAuthToken()
    {
        return $this->auth_token;
    }

    /**
     * Set Twilio auth tokn
     *
     * @param string $auth_token
     * @return Omnimessage\MessageDispatchers\Twilio
     */
    public function setAuthToken($auth_token)
    {
        $this->auth_token = $auth_token;
        return $this;
    }

    /**
     * Send message to Twilio web service
     *
     * @param array $data
     * @return GuzzleHttp\Message\Response
     */
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
