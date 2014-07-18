# Email Message Dispatcher

Send a message via email. The email dispatcher uses swiftmailer
for sending emails.

## Email Dispatcher API

Namespace: Omnimessage\MessageDispatchers\Email

### get()

Get the properties of the dispatcher.

Return: array of properties

### set(array $properties)

Set the properties of the dispatcher.

Parameter: array properties, array of properties to set on the dispatcher

Return: Omnimessage\MessageDispatchers\Email

### getMessage()

Return: Swift_Message object

### setMessage(\Swift_Message $message)

Parameter: Swift_Message message, Swift_Message object

Returns: Omnimessage\MessageDispatchers\Email

### getTransport()

Return: Swift Transport object

### setTransport(string $type='smtp', array $option=array())

Parameter: string type, Transport type (smtp, send_mail, mail) Default: smtp

Parameter: array options, Transport options (Optional, required for smtp)

Return: Omnimessage\MessageDispatchers\Email

### getSubject()

Return: string, subject

### setSubject(string $subject)

Parameter: string subject, Subject for email

Return: Omnimessage\MessageDispatchers\Email

### getFrom()

Return: string|array, from email address

### setFrom(string|array $from)

Parameter: string|array from, from email address

Return: Omnimessage\MessageDispatchers\Email

### getTo()

Return: string|array, to email address

### setTo(string|array $to)

Parameter: string|array, to email address

Return: Omnimessage\MessageDispatchers\Email

### getReplyTo()

Return: string, reply to email address

### setReplyTo(string $reply_to)

Parameter: string reply_to, reply to email address

Return: Omnimessage\MessageDispatchers\Email

### getContentType()

Return: string, content type

### setContentType(string $content_type)

Parameter: string content_type, content type

Return: Omnimessage\MessageDispatchers\Email

### getBody()

Return: string, email body

### setBody(string $body)

Parameter: string body, email body

Return: Omnimessage\MessageDispatchers\Email

### send()

Return: boolean, true on sent or false otherwise

