<?php
namespace Omnimessage\MessageDispatcher;

use Omnimessage\Exception;
use Omnimessage\Service\Email as EmailService;

/**
 * Email message dispatchers
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class Email extends AbstractDispatcher
{
    /**
     * @var string
     */
    private $body;

    /**
     * @var boolean
     */
    private $successful;

    /**
     * @var Omnimessage\Service\Email
     */
    private $email_service;

    /**
     * Create a new Email dispatcher
     */
    public function __construct()
    {
        $this->email_service = new EmailService();
        $this->email_service->setMessage(\Swift_Message::newInstance());
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return array(
            'message'       => $this->getMessage(),
            'transport'     => $this->getTransport(),
            'subject'       => $this->getSubject(),
            'from'          => $this->getFrom(),
            'to'            => $this->getTo(),
            'reply_to'      => $this->getReplyTo(),
            'content_type'  => $this->getContentType(),
            'body'          => $this->getBody(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function set($properties)
    {
        if (isset($properties['message'])) {
            $this->setMessage($properties['message']);
        }

        if (isset($properties['transport']) && is_array($properties['transport'])) {
            $type = isset($properties['transport']['type']) ? $properties['transport']['type'] : 'smtp';
            $options = isset($properties['transport']['options']) ? $properties['transport']['options'] : array();

            $this->setTransport($type, $options);
        }

        if (!empty($properties['subject'])) {
            $this->setSubject($properties['subject']);
        }

        if (!empty($properties['from'])) {
            $from = is_array($properties['from']) ? $properties['from'] : array($properties['from']);

            $this->setFrom($from);
        }

        if (!empty($properties['to'])) {
            $to = is_array($properties['to']) ? $properties['to'] : array($properties['to']);

            $this->setTo($to);
        }

        if (!empty($properties['reply_to'])) {
            $reply_to = is_array($properties['reply_to']) ? $properties['reply_to'] : array($properties['reply_to']);

            $this->setReplyTo($reply_to);
        }

        if (!empty($properties['content_type'])) {
            $this->setContentType($properties['content_type']);
        }

        if (!empty($properties['body'])) {
            $this->setBody($properties['body']);
        }

        return $this;
    }

    /**
     * Get message object
     *
     * @return Swift_Message
     */
    public function getMessage()
    {
        return $this->email_service->getMessage();
    }

    /**
     * Set message object
     *
     * @param Swift_Message $message
     * @return Omnimessage\MessageDispatcher\Email
     */
    public function setMessage(\Swift_Message $message)
    {
        $this->email_service->setMessage($message);
        return $this;
    }

    /**
     * Get transport object
     *
     * @return Swift_Transport
     */
    public function getTransport()
    {
        return $this->email_service->getTransport();
    }

    /**
     * Set transport
     *
     * @param string $type
     * @param array $options
     * @return Omnimessage\MessageDispatcher\Email
     */
    public function setTransport($type='smtp', $options=array())
    {
        $this->email_service->setTransport($type, $options);
        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->getMessage()->getSubject();
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Omnimessage\MessageDispatcher\Email
     */
    public function setSubject($subject)
    {
        $this->getMessage()->setSubject($subject);
        return $this;
    }

    /**
     * Get from
     *
     * @return array
     */
    public function getFrom()
    {
        return $this->getMessage()->getFrom();
    }

    /**
     * Set from
     *
     * @param mixed $from
     * @return Omnimessage\MessageDispatcher\Email
     */
    public function setFrom($from)
    {
        $this->getMessage()->setFrom($from);
        return $this;
    }

    /**
     * Get to
     *
     * @return array
     */
    public function getTo()
    {
        return $this->getMessage()->getTo();
    }

    /**
     * Set to
     *
     * @param mixed $to
     * @return Omnimessage\MessageDispatcher\Email
     */
    public function setTo($to)
    {
        $this->getMessage()->setTo($to);
        return $this;
    }

    /**
     * Get reply to
     *
     * @return array
     */
    public function getReplyTo()
    {
        return $this->getMessage()->getReplyTo();
    }

    /**
     * Set reply to
     *
     * @param mixed $reply_to
     * @return Omnimessage\MessageDispatcher\Email
     */
    public function setReplyTo($reply_to)
    {
        $this->getMessage()->setReplyTo($reply_to);
        return $this;
    }

    /**
     * Get content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->getMessage()->getContentType();
    }

    /**
     * Set content type
     *
     * @param string $content_type
     * @return Omnimessage\MessageDispatcher\Email
     */
    public function setContentType($content_type)
    {
        $this->getMessage()->setContentType($content_type);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->getMessage()->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function setBody($body)
    {
        $this->getMessage()->setBody($body);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        $this->successful = $this->email_service->send(null);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->successful;
    }
}
