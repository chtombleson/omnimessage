<?php
namespace Omnimessage\MessageDispatcher;

use Omnimessage\Exception;
use Omnimessage\Service\Twilio as TwilioService;

/**
 * Twilio message dispatchers
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class Twilio extends AbstractDispatcher
{
    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $to;

    /**
     * @var GuzzleHttp\Message\Response
     */
    private $response;

    /**
     * @var Omnimessage\Service\Twilio
     */
    private $twilio_service;

    /**
     * Create a new Twilio message dispatcher
     */
    public function __construct()
    {
        $this->twilio_service = new TwilioService();
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return array(
            'body'          => $this->getBody(),
            'account_sid'   => $this->getAccountSid(),
            'auth_token'    => $this->getAuthToken(),
            'from'          => $this->getFrom(),
            'to'            => $this->getTo(),
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

        if (!empty($properties['account_sid'])) {
            $this->setAccountSid($properties['account_sid']);
        }

        if (!empty($properties['auth_token'])) {
            $this->setAuthToken($properties['auth_token']);
        }

        if (!empty($properties['from'])) {
            $this->setFrom($properties['from']);
        }

        if (!empty($properties['to'])) {
            $this->setTo($properties['to']);
        }

        return $this;
    }

    /**
     * Get Twilio account sid
     *
     * @return string
     */
    public function getAccountSid()
    {
        return $this->twilio_service->getAccountSid();
    }

    /**
     * Set Twilio account sid
     *
     * @param string $account_sid
     * @return Omnimessage\MessageDispatcher\Twilio
     */
    public function setAccountSid($account_sid)
    {
        $this->twilio_service->setAccountSid($account_sid);
        return $this;
    }

    /**
     * Get Twilio auth token
     *
     * @return string
     */
    public function getAuthToken()
    {
        return $this->twilio_service->getAuthToken();
    }

    /**
     * Set Twilio auth tokn
     *
     * @param string $auth_token
     * @return Omnimessage\MessageDispatcher\Twilio
     */
    public function setAuthToken($auth_token)
    {
        $this->twilio_service->setAuthToken($auth_token);
        return $this;
    }

    /**
     * Get from
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set from
     *
     * @param string $from
     * @return Omnimessage\MessageDispatcher\Twilio
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set to
     *
     * @param string $to
     * @return Omnimessage\MessageDispatcher\Twilio
     */
    public function setTo($to)
    {
        $this->to = $to;
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
            throw new Exception('Twilio dispatcher requires the Body to be set');
        }

        if (empty($this->auth_token) || empty($this->account_sid)) {
            throw new Exception('Twilio dispatcher requires Account Sid & Auth Token to be set');
        }

        if (empty($this->to) || empty($this->from)) {
            throw new Exception('Twilio dispatcher requires To & From to be set');
        }

        $twilio = new TwilioService();
        $response = $this->twilio_service->send(
            array(
                'from'  => $this->getFrom(),
                'to'    => $this->getTo(),
                'body'  => $this->getBody(),
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
        return !in_array($json['status'], array(400, 401, 404));
    }
}
