# Twilio Message Dispatcher

Send a message as sms via Twilio.

## Twilio Dispatcher API

Namespace: Omnimessage\MessageDispatcher\Twilio

### get()

Get the properties of the dispatcher.

Return: array of properties

### set(array $properties)

Set the properties of the dispatcher.

Parameter: array properties, array of properties to set on the dispatcher

Return: Omnimessage\MessageDispatcher\Twilio

### getAccountSid()

Return: string, Twilio account sid

### setAccountSid(string $account_sid)

Parameter: string account_sid, Twilio account sid

Returns: Omnimessage\MessageDispatcher\Twilio

### getAuthToken()

Return: string, Twilio auth token

### setAuthToken(string $auth_token)

Parameter: string auth_token, Twilio auth token

Return: Omnimessage\MessageDispatcher\Twilio

### getFrom()

Return: string, Twilio phone number

### setFrom(string $from)

Parameter: string from, Twilio phone number

Return: Omnimessage\MessageDispatcher\Twilio

### getTo()

Return: string, Cellphone number to send to

### setTo(string $to)

Parameter: string to, Cellphone number to send to

Return: Omnimessage\MessageDispatcher\Twilio

### getBody()

Return: string, Message body

### setBody(string $body)

Parameter: string body, email body

Return: Omnimessage\MessageDispatcher\Twilio

### getResponse()

Return: mixed, response from disptacher

### send()

Return: Omnimessage\MessageDispatcher\Twilio

### isSuccessful()

Return: boolean true if message was sent or false otherwise

