<?php

namespace AppBundle\Controller\Dtp\Standings;

use AppBundle\Entity\Legacy\Config;
use AppBundle\Entity\Legacy\Spieler;
use AppBundle\Entity\Legacy\Tipp;
use AppBundle\Entity\Legacy\Turnier;
use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayersController extends Controller
{
    /**
     * @Route("/tipprunde/{championshipSlug}/spieler", name="players", requirements={"championshipSlug": "\w{2}\d{4}"})
     */
    public function indexAction($championshipSlug = null)
    {
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

        /** @var QueryBuilder $playersQueryBuilder */
        $playersQueryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder();
        $playersQueryBuilder->select('p')
            ->from('Legacy:Spieler', 'p')
            ->join('p.user', 'u')
            ->where('p.turnierId = ?1')
            ->orderBy('u.name', 'ASC')
            ->setParameter(1, $championship->getId());
        $players = $playersQueryBuilder->getQuery()->execute();

        /** @var Spieler $player */
        $player = current($players);

        $tips = [];
        /** @var Tipp $t */
        foreach ($player->getTips() as $t) {
            $tips[$t->getSpielId()] = $t;
        }

        /** @var QueryBuilder $roundsQueryBuilder */
        $roundsQueryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder();
        $roundsQueryBuilder->select(['r', 'm'])
            ->from('Legacy:Runde', 'r')
            ->join('r.matches', 'm')
            ->where('r.turnierId = ?1')
            ->setParameter(1, $championship->getId());
        $rounds = $roundsQueryBuilder->getQuery()->execute();

        return $this->render('dtp/standings/players.html.twig', [
            'championships' => $championships,
            'championship' => $championship,
            'players' => $players,
            'player' => $player,
            'rounds' => $rounds,
            'tips' => $tips
        ]);
    }
}
