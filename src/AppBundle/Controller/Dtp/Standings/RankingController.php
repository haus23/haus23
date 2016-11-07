<?php

namespace AppBundle\Controller\Dtp\Standings;

use AppBundle\Entity\Legacy\Config;
use AppBundle\Entity\Legacy\Turnier;
use AppBundle\MessageBus\Query\GetCurrentChampionship;
use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RankingController extends Controller
{
    /**
     * @Route("/tipprunde/{championshipSlug}", name="ranking", requirements={"championshipSlug": "\w{2}\d{4}"})
     */
    public function indexAction($championshipSlug = null)
    {
        $queryBus = $this->get('lean.querybus');
        dump($queryBus->handle( new GetCurrentChampionship()));

        $configRepository = $this->getDoctrine()->getRepository('Legacy:Config');
        $championshipRepository = $this->getDoctrine()->getRepository('Legacy:Turnier');

        $championships = $championshipRepository->findBy([],['order' => 'ASC']);

        /** @var Turnier $championship */

        if( $championshipSlug == null ) {
            /** @var Config $configEntry */
            $configEntry = $configRepository->findOneBy(['key' => 'turnier']);
            $championshipId = $configEntry->getValue();
            $championship = $championshipRepository->find($championshipId);

        } else {
            $championship = current(array_filter($championships,
                function (Turnier $c) use($championshipSlug) {
                    return $c->getSlug() === $championshipSlug;
                })
            );
            if( $championship == false ) {
                throw $this->createNotFoundException('Ein solches Turnier ' . $championshipSlug . ' gibt es nicht.');
            }
        }


        /** @var QueryBuilder $qb */
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
        $qb->select('p')
            ->from('Legacy:Spieler', 'p')
            ->where('p.turnierId = ?1')
            ->orderBy('p.platz', 'ASC')
            ->setParameter(1, $championship->getId());
        $players = $qb->getQuery()->execute();

        return $this->render('dtp/standings/ranking.html.twig', [
            'championships' => $championships,
            'championship' => $championship,
            'players' => $players
        ]);
    }
}
