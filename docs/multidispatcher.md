# MultiDispatcher

Send messages via more than one dispatcher easily.

## MultiDispatcher API

Namespace: Omnimessage\MultiDispatcher

### __construct(array $dispatchers, array $options)

Create a new instance of MultiDispatcher.

Parameter: array dispacthers, array of message dispatchers you want to create

Parameter: array options, array of dispatcher options

Return: Omnimessage\MultiDispatcher

### getDispatcher(string $dispatcher)

Get the dispatcher object.

Parameter: string dispatcher, Name of dispatcher to get

Return: Omnimessage\MessageDispatchers object

### setDispatcher(string $dispatcher, array $options)

Set a dispatcher.

Parameter: string dispatcher, Name of dispatcher to set

Parameter: array options, array of dispatcher options

Returns: Omnimessage\MultiDispatcher

### send()

Send the messages

Return: array of dispatcher->send() return values
