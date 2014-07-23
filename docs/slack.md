# Slack Message Dispatcher

Send a message via Slack.

## Slack Dispatcher API

Namespace: Omnimessage\MessageDispatchers\Slack

### get()

Get the properties of the dispatcher.

Return: array of properties

### set(array $properties)

Set the properties of the dispatcher.

Parameter: array properties, array of properties to set on the dispatcher

Return: Omnimessage\MessageDispatchers\Slack

### getToken()

Return: string, Slack API token

### setToken(string $token)

Parameter: string token, Slack API token

Returns: Omnimessage\MessageDispatchers\Slack

### getUsername()

Return: string, Username to use when posting to slack

### setUsername(string $username)

Parameter: string username, Username to use when posting to slack

Return: Omnimessage\MessageDispatchers\Slack

### getChannel()

Return: string, Slack channel to post to

### setChannel(string $channel)

Parameter: string channel, Slack channel to post to

Return: Omnimessage\MessageDispatchers\Slack

### getTeam()

Return: string, Slack url eg. [team].slack.com

### setTeam(string $team)

Parameter: string team, Slack url eg. [team].slack.com

Return: Omnimessage\MessageDispatchers\Slack

### getBody()

Return: string, Message body

### setBody(string $body)

Parameter: string body, email body

Return: Omnimessage\MessageDispatchers\Slack

### getResponse()

Return: mixed, response from disptacher

### send()

Return: Omnimessage\MessageDispatchers\Slack

### isSuccessful()

Return: boolean true if message was sent or false otherwise

