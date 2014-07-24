# HipChat Message Dispatcher

Send a message via HipChat.

## HipChat Dispatcher API

Namespace: Omnimessage\MessageDispatcher\HipChat

### get()

Get the properties of the dispatcher.

Return: array of properties

### set(array $properties)

Set the properties of the dispatcher.

Parameter: array properties, array of properties to set on the dispatcher

Return: Omnimessage\MessageDispatcher\HipChat

### getToken()

Return: string, HipChat API token

### setToken(string $token)

Parameter: string token, HipChat API token

Returns: Omnimessage\MessageDispatcher\HipChat

### getRoom()

Return: string, Room to post to

### setRoom(string $room)

Parameter: string username, Room to post to

Return: Omnimessage\MessageDispatcher\HipChat

### getFormat()

Return: string, Format of message (default: html)

### setFormat(string $format)

Parameter: string channel, Format of message (default: html)

Return: Omnimessage\MessageDispatcher\HipChat

### getColor()

Return: string, Color for message

### setColor(string $color)

Parameter: string color, Color of message

Return: Omnimessage\MessageDispatcher\HipChat

### getNotify()

Return: bool, Notify sound

### setNotify(bool $notify)

Parameter: bool notify, Send notification sound

### getBody()

Return: string, Message body

### setBody(string $body)

Parameter: string body, email body

Return: Omnimessage\MessageDispatcher\HipChat

### getResponse()

Return: mixed, response from disptacher

### send()

Return: Omnimessage\MessageDispatcher\HipChat

### isSuccessful()

Return: boolean true if message was sent or false otherwise

