# Web Message Dispatcher

Send a json payload to a url.

## Email Dispatcher API

Namespace: Omnimessage\MessageDispatchers\Web

### get()

Get the properties of the dispatcher.

Return: array of properties

### set(array $properties)

Set the properties of the dispatcher.

Parameter: array properties, array of properties to set on the dispatcher

Return: Omnimessage\MessageDispatchers\Web

### getUrl()

Return: string, Url to POST to

### setUrl(string $url)

Parameter: string url, Url to POST to

Return: Omnimessage\MessageDispatchers\Web

### getBody()

Return: array, JSON payload

### setBody(array $body)

Parameter: array body, JSON payload

Return: Omnimessage\MessageDispatchers\Web

### send()

Return: boolean, true on sent or false otherwise

