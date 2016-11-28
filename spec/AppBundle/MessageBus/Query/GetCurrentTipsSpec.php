<?php

namespace spec\AppBundle\MessageBus\Query;

use AppBundle\MessageBus\Query\GetCurrentTips;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GetCurrentTipsSpec extends ObjectBehavior
{
    function it_is_initializable_with_id()
    {
        $this->beConstructedWith(17);
        $this->shouldHaveType(GetCurrentTips::class);
    }

    function it_has_tournament_id()
    {
        $this->beConstructedWith(17);
        $this->getTournamentId()->shouldBe(17);
    }
}
