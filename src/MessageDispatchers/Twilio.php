<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Exception;
use Omnimessage\Service\Twilio as TwilioService;

class Twilio extends AbstractDispatcher
{
    private $account_sid;
    private $auth_token;
    private $from;
    private $to;

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

        return $response;
    }
}
