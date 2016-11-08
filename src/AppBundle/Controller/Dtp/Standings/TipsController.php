<?php

namespace AppBundle\Controller\Dtp\Standings;

use AppBundle\Entity\Legacy\Runde;
use AppBundle\Entity\Legacy\Spiel;
use AppBundle\Entity\Legacy\Tipp;
use AppBundle\Entity\Legacy\Turnier;
use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TipsController extends Controller
{
    /**
     * @Route("/tipprunde/{championshipSlug}/tipps/{round}/{matchId}/{fixture}", name="tips",
     *     requirements={"championshipSlug": "\w{2}\d{4}", "round": "runde-\d", "matchId": "\d+"},
     *     defaults={"fixture": ""})
     */
    public function indexAction($championshipSlug, $round = null, $matchId = null)
    {
        $championshipRepository = $this->getDoctrine()->getRepository('Legacy:Turnier');
        $roundRepository = $this->getDoctrine()->getRepository('Legacy:Runde');
        $matchRepository = $this->getDoctrine()->getRepository('Legacy:Spiel');

        $championships = $championshipRepository->findBy([],['order' => 'ASC']);

        /** @var Turnier $championship */
        $championship = current(array_filter($championships,
                function (Turnier $c) use($championshipSlug) {
                    return $c->getSlug() === $championshipSlug;
                })
        );
        if( $championship == false ) {
            throw $this->createNotFoundException('Ein solches Turnier ' . $championshipSlug . ' gibt es nicht.');
        }

        $rounds = $championship->getRounds();

        /** @var Runde $selectedRound */
        if( $round == null ) {
            $selectedRound = $championship->getCompleted() ? $rounds->first() : $rounds->last();
        } else {
            $roundNr = substr($round, 6);
            $selectedRound = $rounds->filter( function (Runde $r) use($roundNr) {
                return $r->getNr() == $roundNr;
            })->first();

            if( $selectedRound == false ) {
                throw $this->createNotFoundException('Eine solche Runde ' . $roundNr . ' gibt es nicht.');
            }
        }


        $matches = $selectedRound->getMatches();

        /** @var Spiel $match */
        if( $matchId == null) {
            $match = $matches->first();
            if( !$championship->getCompleted() ) {
                $match = $matches->filter(function(Spiel $m ) {return !empty($m->getErgebnis());})->last();
                if(!$match) { $match = $matches->first(); }
            }
            $matchId = $match->getId();
        } else {
            $match = $matches->filter(function(Spiel $m ) use ($matchId) {return $m->getId() == $matchId; })->first();
        }

        /** @var QueryBuilder $tipQueryBuilder */
        $tipQueryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder();
        $tipQueryBuilder->select('t')
            ->from('Legacy:Tipp', 't')
            ->where('t.spielId = ?1')
            ->setParameter(1, $matchId);

        $tips = $tipQueryBuilder->getQuery()->execute();
        $this->sort($match, $tips);

        /** @var QueryBuilder $playersQueryBuilder */
        $playersQueryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder();
        $playersQueryBuilder->select('p')
            ->from('Legacy:Spieler', 'p', 'p.id')
            ->where('p.turnierId = ?1')
            ->setParameter(1, $championship->getId());
        $players = $playersQueryBuilder->getQuery()->getResult();

        return $this->render('dtp/standings/tips.html.twig', [
            'championships' => $championships,
            'championship' => $championship,
            'players' => $players,
            'rounds' => $rounds,
            'round' => $selectedRound,
            'matches' => $matches,
            'match' => $match,
            'tips' => $tips
        ]);
    }

    /**
     * @param Spiel $match
     * @param Tipp[] $tips
     */
    private function sort(Spiel $match, array &$tips)
    {
        usort($tips, function(Tipp $a, Tipp $b) {
            if( $a->getPunkte() != $b->getPunkte() ) {
                return $b->getPunkte() <=> $a->getPunkte();
            } else {
                // Tipp leer?
                if( empty($a->getTipp())) { return 1; }
                if( empty($b->getTipp())) { return -1; }

                $toreA = explode(':', $a->getTipp());
                $toreB = explode(':', $b->getTipp());

                $diffA = $toreA[0] - $toreA[1];
                $diffB = $toreB[0] - $toreB[1];

                if( $diffA != $diffB ) {
                    return $diffB <=> $diffA;
                } else {
                    return $toreB[0] <=> $toreA[0];
                }
            }
        });
    }
}
