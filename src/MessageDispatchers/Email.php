<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Exception;

class Email extends AbstractDispatcher
{
    private $message;
    private $transport;
    private $available_transports = array(
        'smtp'      => 'Swift_SmtpTransport',
        'send_mail' => 'Swift_SendmailTransport',
        'mail'      => 'Swift_MailTransport',
    );

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

    public function setTransport($type='smtp', $options=array())
    {
        if (!in_array($type, array_keys($this->available_transports))) {
            throw new Exception('Email Transport: ' . $type . ' is not available');
        }

        switch ($type) {
            case 'smtp':
                $class = '\\'. $this->available_transports['smtp'];

                if (!isset($options['host']) && !isset($options['port'])) {
                    throw new Exception('Email Transport smtp requires host & port options');
                }

                $this->transport = $class::newInstance($options['host'], $options['port']);

                if (isset($options['username']) && isset($options['password'])) {
                    $this->transport->setUsername($options['username'])
                        ->setPassword($options['password']);
                }
                break;

            case 'send_mail':
                $class = '\\' . $this->available_transports['send_mail'];
                $cmd = '/usr/sbin/sendmail -bs';

                if (!empty($options['cmd'])) {
                    $cmd = $options['cmd'];
                }

                $this->transport = $class::newInstance($cmd);
                break;

            case 'mail':
                $class = '\\' . $this->available_transports['mail'];
                $this->transport = $class::newInstance();
                break;
        }

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

    public function getBody()
    {
        return $this->message->getBody();
    }

    public function setBody($body)
    {
        $this->message->setBody($body);
        return $this;
    }

    public function send()
    {
        $mailer = \Swift_Mailer::newInstance($this->transport);
        return $mailer->send($this->message);
    }
}
