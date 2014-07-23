<?php
namespace Omnimessage\Service;

use GuzzleHttp\Client;

/**
 * Slack web service client
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class Slack extends AbstractService
{
    /**
     * @var string
     */
    private $token;

    /**
     * Get Slack token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set Slack token
     *
     * @param string $token
     * @return Omnimessage\Service\Slack
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Send message to Slack web service
     *
     * @param array $data
     * @return GuzzleHttp\Message\Response
     */
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

        if ($response->getStatusCode() != 200) {
            throw new Exception('Slack POST error');
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
            )
        );

        return $response;
    }
}
