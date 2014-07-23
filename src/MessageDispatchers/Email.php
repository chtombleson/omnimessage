<?php
namespace Omnimessage\MessageDispatchers;

use Omnimessage\Exception;

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
     * @var Swift_Message
     */
    private $message;

    /**
     * @var Swift_Transport
     */
    private $transport;

    /**
     * @var boolean
     */
    private $successful;

    /**
     * @var array
     */
    private $available_transports = array(
        'smtp'      => 'Swift_SmtpTransport',
        'send_mail' => 'Swift_SendmailTransport',
        'mail'      => 'Swift_MailTransport',
    );

    /**
     * Create a new Email dispatcher
     */
    public function __construct()
    {
        $this->message = \Swift_Message::newInstance();
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
        return $this->message;
    }

    /**
     * Set message object
     *
     * @param Swift_Message $message
     * @return Omnimessage\MessageDispatchers\Email
     */
    public function setMessage(\Swift_Message $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get transport object
     *
     * @return Swift_Transport
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set transport
     *
     * @param string $type
     * @param array $options
     * @return Omnimessage\MessageDispatchers\Email
     */
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

            default:
                throw new Exception('Email transport: ' . $type . ' is not supported');
        }

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->message->getSubject();
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Omnimessage\MessageDispatchers\Email
     */
    public function setSubject($subject)
    {
        $this->message->setSubject($subject);
        return $this;
    }

    /**
     * Get from
     *
     * @return array
     */
    public function getFrom()
    {
        return $this->message->getFrom();
    }

    /**
     * Set from
     *
     * @param mixed $from
     * @return Omnimessage\MessageDispatchers\Email
     */
    public function setFrom($from)
    {
        $this->message->setFrom($from);
        return $this;
    }

    /**
     * Get to
     *
     * @return array
     */
    public function getTo()
    {
        return $this->message->getTo();
    }

    /**
     * Set to
     *
     * @param mixed $to
     * @return Omnimessage\MessageDispatchers\Email
     */
    public function setTo($to)
    {
        $this->message->setTo($to);
        return $this;
    }

    /**
     * Get reply to
     *
     * @return array
     */
    public function getReplyTo()
    {
        return $this->message->getReplyTo();
    }

    /**
     * Set reply to
     *
     * @param mixed $reply_to
     * @return Omnimessage\MessageDispatchers\Email
     */
    public function setReplyTo($reply_to)
    {
        $this->message->setReplyTo($reply_to);
        return $this;
    }

    /**
     * Get content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->message->getContentType();
    }

    /**
     * Set content type
     *
     * @param string $content_type
     * @return Omnimessage\MessageDispatchers\Email
     */
    public function setContentType($content_type)
    {
        $this->message->setContentType($content_type);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->message->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function setBody($body)
    {
        $this->message->setBody($body);
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
        $mailer = \Swift_Mailer::newInstance($this->transport);
        $this->successful = $mailer->send($this->message);
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
