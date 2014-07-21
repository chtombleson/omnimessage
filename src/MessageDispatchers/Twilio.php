<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Exception;
use Omnimessage\Service\Twilio as TwilioService;

class Twilio extends AbstractDispatcher
{
    private $body;
    private $account_sid;
    private $auth_token;
    private $from;
    private $to;
    private $response;

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

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
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

    public function getResponse()
    {
        return $this->response;
    }

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
        $response = $twilio->setAccountSid($this->getAccountSid())
            ->setAuthToken($this->getAuthToken())
            ->send(array(
                'from'  => $this->getFrom(),
                'to'    => $this->getTo(),
                'body'  => $this->getBody(),
            ));

        $this->response = $response;
        return $this;
    }

    public function isSuccessful()
    {
        return !in_array($json['status'], array(400, 401, 404));
    }
}
