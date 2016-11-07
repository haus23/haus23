<?php

namespace spec\Lean\ServiceBus\Resolver;

use Lean\ServiceBus\HandlerInterface;
use Lean\ServiceBus\Resolver\MessageHandlerResolverInterface;
use Lean\ServiceBus\Resolver\MessageTypeResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Validator\Constraints\DateTime;

class MessageTypeResolverSpec extends ObjectBehavior
{
    function it_is_a_message_handler_resolver()
    {
        $this->shouldImplement(MessageHandlerResolverInterface::class);
    }

    function it_returns_an_empty_handler_array_if_no_handler_registered(\stdClass $message)
    {
        $this->resolveHandler($message)->shouldBe([]);
    }

    function it_can_add_a_message_handler(HandlerInterface $handler)
    {
        $message = new \stdClass();
        $this->addHandler(get_class($message), $handler);
        $this->resolveHandler($message)->shouldBe([$handler]);
    }

    function it_can_add_two_handlers(HandlerInterface $handler1, HandlerInterface $handler2)
    {
        $message = new \stdClass();
        $this->addHandler(get_class($message), $handler1);
        $this->addHandler(get_class($message), $handler2);
        $this->resolveHandler($message)->shouldBe([$handler1, $handler2]);
    }

    function it_resolves_handlers_by_message_type(HandlerInterface $handler1, HandlerInterface $handler2)
    {
        $message1 = new \stdClass();
        $message2 = new DateTime();
        $this->addHandler(get_class($message1), $handler1);
        $this->addHandler(get_class($message2), $handler2);
        $this->resolveHandler($message1)->shouldBe([$handler1]);

    }
}
