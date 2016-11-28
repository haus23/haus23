<?php

namespace AppBundle\MessageBus\Query;

class GetCurrentTips
{
    /** @var int */
    private $tournamentId;

    /**
     * GetCurrentMatches constructor.
     *
     * @param string $tournamentId
     */
    public function __construct(int $tournamentId)
    {
        $this->tournamentId = $tournamentId;
    }

    /**
     * @return int
     */
    public function getTournamentId()
    {
        return $this->tournamentId;
    }
}