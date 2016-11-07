<?php

namespace AppBundle\MessageBus\QueryHandler;

use Lean\ServiceBus\HandlerInterface;

class GetCurrentChampionshipHandler implements HandlerInterface
{
    /**
     * @param mixed $message
     * @return mixed
     */
    public function handle($message)
    {
        return 'Yep';
    }
}