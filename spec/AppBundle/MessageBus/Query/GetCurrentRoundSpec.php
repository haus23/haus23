<?php

namespace spec\AppBundle\MessageBus\Query;

use AppBundle\Entity\DTP\Tournament;
use AppBundle\MessageBus\Query\GetCurrentRound;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GetCurrentRoundSpec extends ObjectBehavior
{
    function it_is_initializable(Tournament $tournament)
    {
        $this->beConstructedWith($tournament);
        $this->shouldHaveType(GetCurrentRound::class);
    }

    function it_has_tournament(Tournament $tournament)
    {
        $this->beConstructedWith($tournament);
        $this->getTournament()->shouldBe($tournament);
    }
}
