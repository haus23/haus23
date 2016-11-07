<?php

namespace Lean\ServiceBus\Resolver;

use Lean\ServiceBus\HandlerInterface;

class MessageTypeResolver implements MessageHandlerResolverInterface
{
    /**
     * @var array
     */
    private $handlerMap = [];

    /**
     * @param mixed $message
     * @return HandlerInterface[]
     */
    public function resolveHandler($message)
    {
        return isset($this->handlerMap[get_class($message)]) ? $this->handlerMap[get_class($message)] : [];
    }

    public function addHandler($type, HandlerInterface $handler)
    {
        $this->handlerMap[$type][] = $handler;
    }
}
