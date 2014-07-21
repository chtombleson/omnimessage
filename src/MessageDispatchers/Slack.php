<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Exception;
use Omnimessage\Service\Slack as SlackService;

class Slack extends AbstractDispatcher
{
    private $body;
    private $username;
    private $channel;
    private $team;
    private $token;
    private $response;

    public function get()
    {
        return array(
            'body'      => $this->getBody(),
            'username'  => $this->getUsername(),
            'channel'   => $this->getChannel(),
            'team'      => $this->getTeam(),
            'token'     => $this->getToken(),
        );
    }

    public function set($properties)
    {
        if (!empty($properties['body'])) {
            $this->setBody($properties['body']);
        }

        if (!empty($properties['username'])) {
            $this->setUsername($properties['username']);
        }

        if (!empty($properties['channel'])) {
            $this->setChannel($properties['channel']);
        }

        if (!empty($properties['team'])) {
            $this->setTeam($properties['team']);
        }

        if (!empty($properties['token'])) {
            $this->setToken($properties['token']);
        }

        return $this;
    }


    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }

    public function getTeam()
    {
        return $this->team;
    }

    public function setTeam($team)
    {
        $this->team = $team;
        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function send()
    {
        if (empty($this->body)) {
            throw new Exception('Slack dispatcher requires the Body to be set');
        }

        if (empty($this->token)) {
            throw new Exception('Slack dispatcher requires Token to be set');
        }

        if (empty($this->username) || empty($this->channel) || empty($this->team)) {
            throw new Exception('Slack dispatcher requires Username, Channel & Team to be set');
        }

        $slack = new SlackService();
        $response = $slack->setToken($this->getToken())
            ->send(array(
                'body' => $this->getBody(),
                'username' => $this->getUsername(),
                'channel' => $this->getChannel(),
                'team' => $this->getTeam(),
            ));

        $this->response = $response;
        return $this;
    }

    public function isSuccessful()
    {
        return ($this->response->getStatusCode() == 200);
    }
}
