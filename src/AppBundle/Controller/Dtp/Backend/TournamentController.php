<?php

namespace AppBundle\Controller\Dtp\Backend;

use AppBundle\Entity\DTP\Attendee;
use AppBundle\Entity\DTP\Ruleset;
use AppBundle\Entity\DTP\Tournament;
use AppBundle\Form\DTP\RulesetType;
use AppBundle\Form\DTP\TournamentType;
use AppBundle\Service\DtpService;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TournamentController extends Controller
{
    /**
     * @Route("/tournament/create", name="dtp.tournament.create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $tournament = new Tournament();
        $form = $this->createForm(TournamentType::class, $tournament);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager('dtp');
            $em->persist($tournament);
            $em->flush();

            $msg = 'Turnier <b>' . $form->get('name')->getData() . '</b> wurde hinzugefügt.';
            $this->addFlash('success', $msg);

            return $this->redirectToRoute('dtp.dashboard');
        }

        return $this->render('dtp/backend/tournament/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/tournament/players", name="dtp.tournament.players")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function playersAction(Request $request)
    {
        /** @var DtpService $dtp */
        $dtp = $this->get('dtp');
        $em = $this->getDoctrine()->getManager('dtp');

        $tournament = $em->find('DTP:Tournament', $dtp->getTournament()->getId());

        // All players
        $players = $em->getRepository('DTP:Player')->findAll();
        // Current players
        $attendees = $tournament->getAttendees();

        return $this->render('dtp/backend/tournament/players.html.twig', [
            'players' => $players,
            'attendees' => $attendees
        ]);
    }

    /**
     * @Route("/tournament/players/add", name="dtp.tournament.add_player")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addPlayerAction(Request $request)
    {
        $playerId = $request->get('playerId');

        /** @var DtpService $dtp */
        $dtp = $this->get('dtp');
        $tournamentId = $dtp->getTournament()->getId();

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager('dtp');

        // update nr
        $dql = 'SELECT MAX(a.nr) FROM DTP:Attendee a WHERE a.tournamentId = ?1';
        $nr = $em->createQuery($dql)
                ->setParameter(1, $tournamentId)
                ->getSingleScalarResult() + 1;

        $attendee = new Attendee();
        $attendee->setTournament($em->getReference('DTP:Tournament', $tournamentId));
        $attendee->setPlayer($em->getReference('DTP:Player', $playerId));
        $attendee->setNr($nr);

        $em->persist($attendee);
        $em->flush();

        return $this->redirectToRoute('dtp.tournament.players');
    }
}
