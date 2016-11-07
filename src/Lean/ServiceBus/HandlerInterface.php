<?php

namespace Lean\ServiceBus;

interface HandlerInterface {

    /**
     * @param mixed $message
     * @return mixed
     */
    public function handle($message);
}