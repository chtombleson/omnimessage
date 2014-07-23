<?php
namespace Omnimessage\Service;

/**
 * Email service
 *
 * @author Christopher Tombleson <chris@cribznetwork.com>
 */
class Email extends AbstractService
{
    /**
     * @var array
     */
    private static $transports = array(
        'smtp' => 'Swift_SmtpTransport',
        'mail' => 'Swift_MailTransport',
        'send_mail' => 'Swift_SendmailTransport',
    );

    /**
     * @var Swift_Message
     */
    private $message;

    /**
     * @var Swift_Transport
     */
    private $transport;

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
     * @return Omnimessage\Service\Email
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
     * @return Omnimessage\Service\Email
     */
    public function setTransport($type='smtp', $options=array())
    {
        if (!in_array($type, array_keys(self::$transports))) {
            throw new Exception('Email Transport: ' . $type . ' is not available');
        }

        switch ($type) {
            case 'smtp':
                $class = '\\'. self::$transports['smtp'];

                if (!isset($options['host']) && !isset($options['port'])) {
                    throw new Exception('Email Transport smtp requires host & port options');
                }

                $this->transport = $class::newInstance($options['host'], $options['port']);

                if (isset($options['username']) && isset($options['password'])) {
                    $this->transport->setUsername($options['username'])
                        ->setPassword($options['password']);
                }

                if (isset($options['encryption']) && in_array($options['encryption'], array('ssl', 'tls'))) {
                    $this->transport->setEncryption($options['encryption']);
                }
                break;

            case 'send_mail':
                $class = '\\' . self::$transports['send_mail'];
                $cmd = '/usr/sbin/sendmail -bs';

                if (!empty($options['cmd'])) {
                    $cmd = $options['cmd'];
                }

                $this->transport = $class::newInstance($cmd);
                break;

            case 'mail':
                $class = '\\' . self::$transports['mail'];
                $this->transport = $class::newInstance();
                break;

            default:
                throw new Exception('Email transport: ' . $type . ' is not supported');
        }

        return $this;
    }

    /**
     * Send Email
     *
     * @return boolean
     */
    public function send($data)
    {
        $mailer = \Swift_Mailer::newInstance($this->getTransport());
        return $mailer->send($this->getMessage());
    }

    /**
     * Get a list of available transports
     *
     * @return array
     */
    public static function getTransports()
    {
        return array_keys(self::$transports);
    }
}
