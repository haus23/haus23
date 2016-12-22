<?php

namespace AppBundle\MessageBus\Query;

use AppBundle\Entity\DTP\Tournament;

class GetCurrentTips
{
    /** @var Tournament */
    private $tournament;

    /**
     * GetCurrentMatches constructor.
     *
     * @param Tournament $tournament
     */
    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    /**
     * @return Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }
}