<?php

namespace AppBundle\MessageBus\QueryHandler;

use AppBundle\Entity\Legacy\Tipp;
use AppBundle\MessageBus\Query\GetCurrentTips;
use Doctrine\ORM\EntityManager;
use Lean\ServiceBus\HandlerInterface;

class GetCurrentTipsHandler implements HandlerInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * GetCurrentTipsHandler constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param GetCurrentTips $message
     * @return array
     */
    public function handle($message)
    {
        // find the current matches ...

        $lastMatchesQuery = "
            SELECT s.id, s.paarung, s.ergebnis FROM Legacy:Spiel s INDEX BY s.id WHERE s.turnierId = :id
            AND s.ergebnis <> '' ORDER BY s.datum DESC";
        $query = $this->entityManager->createQuery($lastMatchesQuery);
        $query->setParameter('id', $message->getTournament()->getId());
        $query->setMaxResults(2);
        $lastMatches = $query->getResult();

        $nextMatchesQuery = "
            SELECT s.id, s.paarung, s.ergebnis FROM Legacy:Spiel s INDEX BY s.id WHERE s.turnierId = :id
            AND s.ergebnis = '' ORDER BY s.datum ASC";
        $query = $this->entityManager->createQuery($nextMatchesQuery);
        $query->setParameter('id', $message->getTournament()->getId());
        $query->setMaxResults(2);
        $nextMatches = $query->getResult();

        $matches = array_map(function ($match){
            $match['tips'] = [];
            return $match;
        }, $lastMatches + $nextMatches);

        // and their tips
        $tipsQuery = "SELECT t.spielId, t.spielerId, t.tipp, t.punkte, t.joker, t.zusatzjoker, t.sonder FROM Legacy:Tipp t WHERE t.spielId IN (:ids)";
        $query = $this->entityManager->createQuery($tipsQuery);
        $query->setParameter('ids', array_keys($matches));
        $tips = $query->execute();

        /** @var Tipp $t */
        foreach ($tips as $t) {
            $matches[$t['spielId']]['tips'][$t['spielerId']] = $t;
        }

        return $matches;
    }
}
