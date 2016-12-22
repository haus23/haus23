<?php

namespace AppBundle\MessageBus\Query;

use AppBundle\Entity\DTP\Tournament;

class GetCurrentRound
{
    /**
     * @var Tournament
     */
    private $tournament;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function getTournament()
    {
        return $this->tournament;
    }
}
