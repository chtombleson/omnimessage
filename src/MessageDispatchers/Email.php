<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Exception;

class Email extends AbstractDispatcher
{
    private $properties = array();
    private $message;
    private $transport;

    public function __construct()
    {
        $this->message = \Swift_Message::newInstance();
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage(\Swift_Message $message)
    {
        $this->message = $message;
        return $this;
    }

    public function getTransport()
    {
        return $this->transport;
    }

    public function setTransport($transport)
    {
        $this->transport = $transport;
        return $this;
    }

    public function getSubject()
    {
        return $this->message->getSubject();
    }

    public function setSubject($subject)
    {
        $this->message->setSubject($subject);
        return $this;
    }

    public function getFrom()
    {
        return $this->message->getFrom();
    }

    public function setFrom($from)
    {
        $this->message->setFrom($from);
        return $this;
    }

    public function getTo()
    {
        return $this->message->getTo();
    }

    public function setTo($to)
    {
        $this->message->setTo($to);
        return $this;
    }

    public function getReplyTo()
    {
        return $this->message->getReplyTo();
    }

    public function setReplyTo($reply_to)
    {
        $this->message->setReplyTo($reply_to);
        return $this;
    }

    public function getContentType()
    {
        return $this->message->getContentType();
    }

    public function setContentType($content_type)
    {
        $this->message->setContentType($content_type);
        return $this;
    }

    public function send($message)
    {
        $this->message->setBody($message);

        $mailer = \Swift_Mailer::newInstance($this->transport);
        return $mailer->send($this->message);
    }
}
