# Twilio Message Dispatcher

Send a message as sms via Twilio.

## Twilio Dispatcher API

Namespace: Omnimessage\MessageDispatchers\Twilio

### get()

Get the properties of the dispatcher.

Return: array of properties

### set(array $properties)

Set the properties of the dispatcher.

Parameter: array properties, array of properties to set on the dispatcher

Return: Omnimessage\MessageDispatchers\Twilio

### getAccountSid()

Return: string, Twilio account sid

### setAccountSid(string $account_sid)

Parameter: string account_sid, Twilio account sid

Returns: Omnimessage\MessageDispatchers\Twilio

### getAuthToken()

Return: string, Twilio auth token

### setAuthToken(string $auth_token)

Parameter: string auth_token, Twilio auth token

Return: Omnimessage\MessageDispatchers\Twilio

### getFrom()

Return: string, Twilio phone number

### setFrom(string $from)

Parameter: string from, Twilio phone number

Return: Omnimessage\MessageDispatchers\Twilio

### getTo()

Return: string, Cellphone number to send to

### setTo(string $to)

Parameter: string to, Cellphone number to send to

Return: Omnimessage\MessageDispatchers\Twilio

### getBody()

Return: string, Message body

### setBody(string $body)

Parameter: string body, email body

Return: Omnimessage\MessageDispatchers\Twilio

### getResponse()

Return: mixed, response from disptacher

### send()

Return: Omnimessage\MessageDispatchers\Twilio

### isSuccessful()

Return: boolean true if message was sent or false otherwise

