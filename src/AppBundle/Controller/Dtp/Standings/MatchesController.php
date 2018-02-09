<?php

namespace AppBundle\Controller\Dtp\Standings;

use AppBundle\Entity\Legacy\Turnier;
use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MatchesController extends Controller
{
    /**
     * @Route("/tipprunde/{championshipSlug}/spiele", name="matches",
     *     requirements={"championshipSlug": "\w{2}\d{4}"})
     */
    public function indexAction($championshipSlug)
    {
        $championshipRepository = $this->getDoctrine()->getRepository('Legacy:Turnier');

        $championships = $championshipRepository->findBy([],['order' => 'DESC']);

        /** @var Turnier $championship */
        $championship = current(array_filter($championships,
                function (Turnier $c) use($championshipSlug) {
                    return $c->getSlug() === $championshipSlug;
                })
        );
        if( $championship == false ) {
            throw $this->createNotFoundException('Ein solches Turnier ' . $championshipSlug . ' gibt es nicht.');
        }

        /** @var QueryBuilder $roundsQueryBuilder */
        $roundsQueryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder();
        $roundsQueryBuilder->select(['r', 'm'])
            ->from('Legacy:Runde', 'r')
            ->join('r.matches', 'm')
            ->where('r.turnierId = ?1')
            ->setParameter(1, $championship->getId());
        $rounds = $roundsQueryBuilder->getQuery()->execute();

        // letztes Spiel ermitteln
        $lastMatchId = 0;
        if (!$championship->getCompleted()) {
            foreach ($rounds as $round) {
                foreach ($round->getMatches() as $match) {
                    if (strlen($match->getErgebnis()) > 0) {
                        $lastMatchId = $match->getId();
                    }
                }
            }
        }

        return $this->render('dtp/standings/matches.html.twig', [
            'championships' => $championships,
            'championship' => $championship,
            'rounds' => $rounds,
            'lastMatchId' => $lastMatchId
        ]);
    }
}
