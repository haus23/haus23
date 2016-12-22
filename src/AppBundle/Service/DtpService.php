<?php

namespace AppBundle\Service;

use AppBundle\Entity\DTP\Round;
use AppBundle\Entity\DTP\Tournament;
use AppBundle\MessageBus\Query\GetCurrentRound;
use AppBundle\MessageBus\Query\GetCurrentTournament;
use Lean\ServiceBus\QueryBus;

class DtpService
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * @var Tournament
     */
    private $tournament;

    /**
     * DtpService constructor.
     * @param QueryBus $queryBus
     */
    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @return Tournament
     */
    public function getTournament()
    {
        if ($this->tournament == null) {
            $this->tournament = $this->queryBus->handle(new GetCurrentTournament());
        }

        return $this->tournament;
    }

    /**
     * @return Round
     */
    public function getRound()
    {
        return $this->queryBus->handle(new GetCurrentRound($this->getTournament()));
    }
}
