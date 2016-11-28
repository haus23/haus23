<?php

namespace spec\AppBundle\MessageBus\QueryHandler;

use AppBundle\MessageBus\QueryHandler\GetCurrentTipsHandler;
use Doctrine\DBAL\Connection;
use Lean\ServiceBus\HandlerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GetCurrentTipsHandlerSpec extends ObjectBehavior
{
    function let(Connection $conn)
    {
        $this->beConstructedWith($conn);
    }

    function it_is_messagebus_handler()
    {
        $this->shouldImplement(HandlerInterface::class);
    }
}
