<?php

namespace spec\AppBundle\MessageBus\QueryHandler;

use AppBundle\MessageBus\QueryHandler\GetCurrentTipsHandler;
use Doctrine\ORM\EntityManager;
use Lean\ServiceBus\HandlerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GetCurrentTipsHandlerSpec extends ObjectBehavior
{
    function let(EntityManager $conn)
    {
        $this->beConstructedWith($conn);
    }

    function it_is_messagebus_handler()
    {
        $this->shouldImplement(HandlerInterface::class);
    }
}
