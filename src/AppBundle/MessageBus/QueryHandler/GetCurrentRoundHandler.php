<?php

namespace AppBundle\MessageBus\QueryHandler;

use AppBundle\Entity\DTP\Round;
use AppBundle\MessageBus\Query\GetCurrentRound;
use Doctrine\ORM\EntityManager;
use Lean\ServiceBus\HandlerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GetCurrentRoundHandler implements HandlerInterface
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
     * @param GetCurrentRound $message
     * @return Round
     */
    public function handle($message)
    {
        $round = $this->entityManager->getRepository('DTP:Round')->findOneBy(
            ['tournament' => $message->getTournament()],
            ['nr' => 'DESC'])
        ;

        return $round;
    }
}
