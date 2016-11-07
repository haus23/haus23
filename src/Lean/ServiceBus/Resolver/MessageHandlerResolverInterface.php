<?php

namespace Lean\ServiceBus\Resolver;

use Lean\ServiceBus\HandlerInterface;

interface MessageHandlerResolverInterface
{
    /**
     * @param mixed $message
     * @return HandlerInterface[]
     */
    public function resolveHandler($message);
}