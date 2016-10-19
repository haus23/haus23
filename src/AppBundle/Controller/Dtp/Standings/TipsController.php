<?php

namespace AppBundle\Controller\Dtp\Standings;

use AppBundle\Entity\Legacy\Runde;
use AppBundle\Entity\Legacy\Turnier;
use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TipsController extends Controller
{
    /**
     * @Route("/tipprunde/{championshipSlug}/tipps/runde-{roundNr}/{matchId}/{fixture}", name="tips",
     *     requirements={"championshipSlug": "\w{2}\d{4}", "roundNr": "\d", "matchId": "\d+"},
     *     defaults={"fixture": ""})
     */
    public function indexAction($championshipSlug, $roundNr, $matchId)
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

        /** @var Runde $round */
        $round = $roundRepository->findOneBy(['turnierId' => $championship->getId(), 'nr' => $roundNr]);
        if( $round == null ) {
            throw $this->createNotFoundException('Eine solche Runde ' . $roundNr . ' gibt es nicht.');
        }

        $matches = $round->getMatches();

        /** @var QueryBuilder $matchQueryBuilder */
        $matchQueryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder();
        $matchQueryBuilder->select(['m', 't'])
            ->from('Legacy:Spiel', 'm')
            ->join('m.tips', 't')
            ->where('m.id = ?1')
            ->setParameter(1, $matchId);
        $match = $matchQueryBuilder->getQuery()->execute();

        return $this->render('dtp/standings/tips.html.twig', [
            'championships' => $championships,
            'championship' => $championship,
            'round' => $round,
            'matches' => $matches,
            'match' => $match[0]
        ]);
    }
}
