<?php

namespace AppBundle\Service;

use AppBundle\Entity\DTP\Tournament;
use AppBundle\MessageBus\Query\GetCurrentTournament;
use Lean\ServiceBus\QueryBus;

class DtpService
{
    /**
     * @var QueryBus
     */
    private $queryBus;

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
        return $this->queryBus->handle(new GetCurrentTournament());
    }
}