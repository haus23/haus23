<?php

namespace AppBundle\MessageBus\QueryHandler;

use AppBundle\Entity\DTP\Tournament;
use AppBundle\MessageBus\Query\GetCurrentTournament;
use Doctrine\ORM\EntityManager;
use Lean\ServiceBus\HandlerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GetCurrentTournamentHandler implements HandlerInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * GetCurrentTipsHandler constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    /**
     * @param GetCurrentTournament $message
     * @return Tournament
     */
    public function handle($message)
    {
        if ($this->session->has('dtp.backend.tournament')) {
            $tournament = $this->session->get('dtp.backend.tournament');
        } else {
            $tournament = $this->entityManager->getRepository('DTP:Tournament')->findOneBy([], ['startDate' => 'DESC']);
            if( $tournament !== null) {
                $this->session->set('dtp.backend.tournament', $tournament);
            }
        }
        return $tournament;
    }
}
