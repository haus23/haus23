<?php

namespace spec\AppBundle\Service;

use AppBundle\Entity\DTP\Tournament;
use AppBundle\Entity\DTP\Round;
use AppBundle\MessageBus\Query\GetCurrentTournament;
use AppBundle\MessageBus\Query\GetCurrentRound;
use AppBundle\Service\DtpService;
use Lean\ServiceBus\QueryBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DtpServiceSpec extends ObjectBehavior
{

    function it_is_initializable(QueryBus $queryBus)
    {
        $this->beConstructedWith($queryBus);
        $this->shouldHaveType(DtpService::class);
    }

    function it_has_current_tournament(QueryBus $queryBus, Tournament $tournament)
    {
        $this->beConstructedWith($queryBus);

        $query = new GetCurrentTournament();
        $queryBus->handle($query)->willReturn($tournament);

        $this->getTournament()->shouldBe($tournament);
    }

    function it_has_current_round(QueryBus $queryBus, Round $round)
    {
        $this->beConstructedWith($queryBus);

        $tournament = new Tournament();
        $queryTournament = new GetCurrentTournament();
        $queryRound = new GetCurrentRound($tournament);

        $queryBus->handle($queryTournament)->willReturn($tournament);
        $queryBus->handle($queryRound)->willReturn($round);

        $this->getRound()->shouldBe($round);
    }

}
