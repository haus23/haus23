<?php

namespace AppBundle\Controller\Dtp\Standings;

use AppBundle\Entity\Legacy\Config;
use AppBundle\Entity\Legacy\Turnier;
use AppBundle\MessageBus\Query\GetCurrentTips;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Dtp\ReadModel\Tournament;
use Lean\ServiceBus\QueryBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class RankingController extends Controller
{
    /**
     * @Route("/tipprunde/{championshipSlug}", name="ranking", requirements={"championshipSlug": "\w{2}\d{4}"})
     * @param string $championshipSlug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(string $championshipSlug = null)
    {
        /** @var EntityRepository $configRepository */
        $configRepository = $this->getDoctrine()->getRepository('Legacy:Config');

        /** @var Config $configEntry */
        $configEntry = $configRepository->findOneBy(['key' => 'turnier']);
        $currentChampionshipId = intval($configEntry->getValue());

        /** @var EntityRepository $championshipRepository */
        $championshipRepository = $this->getDoctrine()->getRepository('Legacy:Turnier');

        $championships = $championshipRepository->findBy([], ['order' => 'ASC']);

        /** @var Turnier $championship */

        if ($championshipSlug == null) {
            $championship = $championshipRepository->find($currentChampionshipId);
        } else {
            $championship = current(array_filter($championships,
                    function (Turnier $c) use ($championshipSlug) {
                        return $c->getSlug() === $championshipSlug;
                    })
            );
            if ($championship == false) {
                throw $this->createNotFoundException('Ein solches Turnier ' . $championshipSlug . ' gibt es nicht.');
            }
        }

        $tips = null;
        if ($championship->getId() === $currentChampionshipId) {

            /** @var QueryBus $queryBus */
            $queryBus = $this->get('lean.querybus');

            $query = new GetCurrentTips($currentChampionshipId);
            $tips = $queryBus->handle($query);
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
            'players' => $players,
            'tips' => $tips
        ]);
    }
}
