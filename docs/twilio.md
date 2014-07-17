# Twilio Message Dispatcher

Send a message as sms via Twilio.

## Twilio Dispatcher API

Namespace: Omnimessage\MessageDispatchers\Twilio

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

### send()

Return: array, Twilio response

