<?php

namespace Lean\ServiceBus\Exception;

class HandlerNotFoundException extends \LogicException
{

    /**
     * HandlerNotFoundException constructor.
     *
     * @param string $msg
     */
    public function __construct(string $msg)
    {
        parent::__construct($msg);
    }
}