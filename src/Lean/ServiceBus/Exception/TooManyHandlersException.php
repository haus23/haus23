<?php

namespace Lean\ServiceBus\Exception;

class TooManyHandlersException extends \LogicException
{
    /**
     * TooManyHandlersException constructor.
     *
     * @param string $msg
     */
    public function __construct(string $msg)
    {
        parent::__construct($msg);
    }
}