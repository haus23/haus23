<?php

namespace Lean\ServiceBus;

use Lean\ServiceBus\Exception\HandlerNotFoundException;
use Lean\ServiceBus\Exception\TooManyHandlersException;
use Lean\ServiceBus\Resolver\MessageHandlerResolverInterface;

class QueryBus implements HandlerInterface
{
    /**
     * @var MessageHandlerResolverInterface
     */
    private $messageHandlerResolver;

    /**
     * QueryBus constructor.
     * @param MessageHandlerResolverInterface $messageHandlerResolver
     */
    public function __construct(MessageHandlerResolverInterface $messageHandlerResolver)
    {
        $this->messageHandlerResolver = $messageHandlerResolver;
    }

    /**
     * @param mixed $message
     * @return mixed
     */
    public function handle($message)
    {
        $handlers = $this->messageHandlerResolver->resolveHandler($message);
        if( count($handlers) == 0 ) {
            throw new HandlerNotFoundException('No handler registered for query ' . get_class($message));
        } elseif( count($handlers) > 1 ) {
            throw new TooManyHandlersException('Only one handler for query ' . get_class($message) . ' must be defined.');
        }

        $handler = $handlers[0];
        return $handler->handle($message);
    }
}
