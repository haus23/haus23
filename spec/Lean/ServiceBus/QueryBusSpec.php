<?php

namespace spec\Lean\ServiceBus;

use Lean\ServiceBus\Exception\HandlerNotFoundException;
use Lean\ServiceBus\Exception\TooManyHandlersException;
use Lean\ServiceBus\HandlerInterface;
use Lean\ServiceBus\QueryBus;
use Lean\ServiceBus\Resolver\MessageHandlerResolverInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QueryBusSpec extends ObjectBehavior
{
    function it_dispatches_to_a_query_handler(
        \stdClass $message,
        MessageHandlerResolverInterface $resolver,
        HandlerInterface $handler
    )
    {
        $this->beConstructedWith($resolver);

        $resolver->resolveHandler($message)->willReturn([$handler]);
        $handler->handle($message)->shouldBeCalled();

        $this->handle($message);
    }

    function it_throws_an_execption_if_no_handler_is_defined(
        \stdClass $message,
        MessageHandlerResolverInterface $resolver
    )
    {
        $this->beConstructedWith($resolver);

        $resolver->resolveHandler($message)->willReturn([]);

        $this->shouldThrow(HandlerNotFoundException::class)->during('handle', [$message]);
    }

    function it_throws_an_execption_if_more_than_one_handler_is_defined(
        \stdClass $message,
        MessageHandlerResolverInterface $resolver,
        HandlerInterface $handler
    )
    {
        $this->beConstructedWith($resolver);

        $resolver->resolveHandler($message)->willReturn([$handler,$handler]);

        $this->shouldThrow(TooManyHandlersException::class)->during('handle', [$message]);
    }

}
