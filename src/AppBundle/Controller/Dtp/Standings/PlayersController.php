<?php

namespace AppBundle\Controller\Dtp\Standings;

use AppBundle\Entity\Legacy\Config;
use AppBundle\Entity\Legacy\Runde;
use AppBundle\Entity\Legacy\Spiel;
use AppBundle\Entity\Legacy\Spieler;
use AppBundle\Entity\Legacy\Tipp;
use AppBundle\Entity\Legacy\Turnier;
use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayersController extends Controller
{
    /**
     * @Route("/tipprunde/{championshipSlug}/spieler/{userSlug}", name="players",
     *     requirements={"championshipSlug": "\w{2}\d{4}", "userSlug": "[\w-]+"})
     */
    public function indexAction($championshipSlug, $userSlug = null)
    {
        $championshipRepository = $this->getDoctrine()->getRepository('Legacy:Turnier');

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
        if( $userSlug == null ) {
            $player = current($players);
        } else {
            $player = current(array_filter($players,
                    function (Spieler $p) use($userSlug) {
                        return $p->getUser()->getSlug() === $userSlug;
                    })
            );
            if( $player == false ) {
                throw $this->createNotFoundException('Einen Spieler ' . $userSlug . ' gibt es nicht.');
            }
        }

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

        $stats = [];
        $stats['total'] = [];
        $stats['total']['totalMatches'] = 0;
        $stats['total']['playedMatches'] = 0;
        $stats['total']['points'] = 0;

        /** @var Runde $round */
        foreach ($rounds as $round) {
            $stats[$round->getId()] = [];
            // Anzahl Spiele gesamt
            $stats[$round->getId()]['totalMatches'] = $round->getAnzahlSpiele();
            $stats['total']['totalMatches'] += $round->getAnzahlSpiele();
            // Anzahl Spiele gespielt, nebenbei letztes Spiel ermitteln
            $lastMatchId = 0;
            $playedMatches = array_reduce($round->getMatches()->toArray(),function($count, Spiel $match) use (&$lastMatchId) {
                if ( strlen($match->getErgebnis()) > 0 ) {
                    $lastMatchId = $match->getId();
                    $count += 1;
                }
                return $count;
            }, 0);
            $stats[$round->getId()]['playedMatches'] = $playedMatches;
            $stats['total']['playedMatches'] += $playedMatches;
            // Gesammelte Punkte
            $points = array_reduce($round->getMatches()->toArray(),function($count, Spiel $match) use ($tips) {
                /** @var Tipp $tipp */
                $tipp = $tips[$match->getId()];
                $count += $tipp->getPunkte();
                return $count;
            }, 0);
            $stats[$round->getId()]['points'] = $points;
            $stats['total']['points'] += $points;
            // Durchscnittspunkte
            $stats[$round->getId()]['average'] = $playedMatches > 0 ? $points / $playedMatches : '';
        }
        $stats['total']['average'] = $stats['total']['playedMatches'] > 0 ?
            $stats['total']['points'] / $stats['total']['playedMatches'] : '';

        return $this->render('dtp/standings/players.html.twig', [
            'championships' => $championships,
            'championship' => $championship,
            'players' => $players,
            'player' => $player,
            'rounds' => $rounds,
            'tips' => $tips,
            'stats' => $stats,
            'lastMatchId' => $lastMatchId
        ]);
    }
}
