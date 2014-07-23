<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Exception;
use Omnimessage\Service\Slack as SlackService;

/**
 * Slack message dispatchers
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class Slack extends AbstractDispatcher
{
    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $channel;

    /**
     * @var string
     */
    private $team;

    /**
     * @var GuzzleHttp\Message\Response
     */
    private $response;

    /**
     * @var Omnimessage\Service\Slack
     */
    private $slack_service;

    /**
     * Create a new Slack message dispatcher
     */
    public function __construct()
    {
        $this->slack_service = new SlackService();
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Get Slack auth token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->slack_service->getToken();
    }

    /**
     * Set Slack auth token
     *
     * @param string $token
     * @return Omnimessage\MessageDispatchers\Slack
     */
    public function setToken($token)
    {
        $this->slack_service->setToken($token);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get Slack username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set Slack username
     *
     * @param string $username
     * @return Omnimessage\MessageDispatchers\Slack
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get Slack channel
     *
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set Slack channel
     *
     * @param string $channel
     * @return Omnimessage\MessageDispatchers\Slack
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Get Slack team
     *
     * @return string
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set Slack team
     *
     * @param string $team
     * @return Omnimessage\MessageDispatchers\Slack
     */
    public function setTeam($team)
    {
        $this->team = $team;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * {@inheritdoc}
     */
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

        $response = $this->slack_service->send(
            array(
                'body' => $this->getBody(),
                'username' => $this->getUsername(),
                'channel' => $this->getChannel(),
                'team' => $this->getTeam(),
            )
        );

        $this->response = $response;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return ($this->response->getStatusCode() == 200);
    }
}
