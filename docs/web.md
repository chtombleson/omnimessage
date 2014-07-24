# Web Message Dispatcher

Send a json payload to a url.

## Email Dispatcher API

Namespace: Omnimessage\MessageDispatcher\Web

### get()

Get the properties of the dispatcher.

Return: array of properties

### set(array $properties)

Set the properties of the dispatcher.

Parameter: array properties, array of properties to set on the dispatcher

Return: Omnimessage\MessageDispatcher\Web

### getUrl()

Return: string, Url to POST to

### setUrl(string $url)

Parameter: string url, Url to POST to

Return: Omnimessage\MessageDispatcher\Web

### getBody()

Return: array, JSON payload

### setBody(array $body)

Parameter: array body, JSON payload

Return: Omnimessage\MessageDispatcher\Web

### getResponse()

Return: mixed, response from disptacher

### send()

Return: Omnimessage\MessageDispatcher\Web

### isSuccessful()

Return: boolean true if message was sent or false otherwise

