<?php

namespace spec\AppBundle\MessageBus\Query;

use AppBundle\Entity\DTP\Tournament;
use AppBundle\MessageBus\Query\GetCurrentTips;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GetCurrentTipsSpec extends ObjectBehavior
{
    function it_is_initializable_with_tournament()
    {
        $this->beConstructedWith(new Tournament());
        $this->shouldHaveType(GetCurrentTips::class);
    }

    function it_has_tournament()
    {
        $tournament = new Tournament();
        $this->beConstructedWith($tournament);
        $this->getTournament()->shouldBe($tournament);
    }
}
