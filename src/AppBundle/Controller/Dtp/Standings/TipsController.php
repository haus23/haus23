<?php

namespace AppBundle\Controller\Dtp\Standings;

use AppBundle\Entity\Legacy\Runde;
use AppBundle\Entity\Legacy\Spiel;
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

        if( $matchId == null) {
            if( $championship->getCompleted() ) {
                $matchId = $matches->first()->getId();
            } else {
                $matchId = $matches->filter(function(Spiel $m ) {return !empty($m->getErgebnis());})->last();
            }
        }

        /** @var QueryBuilder $matchQueryBuilder */
        $matchQueryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder();
        $matchQueryBuilder->select(['m', 't'])
            ->from('Legacy:Spiel', 'm')
            ->join('m.tips', 't')
            ->where('m.id = ?1')
            ->setParameter(1, $matchId);
        $match = $matchQueryBuilder->getQuery()->execute();

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
            'match' => $match[0]
        ]);
    }
}
