<?php

namespace AppBundle\Controller\Dtp\Standings;

use AppBundle\Entity\Config;
use AppBundle\Entity\Turnier;
use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RankingController extends Controller
{
    /**
     * @Route("/tipprunde/", name="ranking")
     */
    public function indexAction()
    {
        $configRepository = $this->getDoctrine()->getRepository('Legacy:Config');
        $championshipRepository = $this->getDoctrine()->getRepository('Legacy:Turnier');

        /** @var Config $configEntry */
        $configEntry = $configRepository->findOneBy(['key' => 'turnier']);
        $championshipId = $configEntry->getValue();

        /** @var Turnier $championship */
        $championship = $championshipRepository->find($championshipId);

        /** @var QueryBuilder $qb */
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
        $qb->select('p')
            ->from('Legacy:Spieler', 'p')
            ->where('p.turnierId = ?1')
            ->orderBy('p.platz', 'ASC')
            ->setParameter(1, $championshipId);
        $players = $qb->getQuery()->execute();

        return $this->render('dtp/standings/ranking.html.twig', [
            'championship' => $championship,
            'players' => $players
        ]);
    }
}
