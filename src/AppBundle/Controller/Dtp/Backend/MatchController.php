<?php

namespace AppBundle\Controller\Dtp\Backend;

use AppBundle\Entity\DTP\Match;
use AppBundle\Entity\DTP\Round;
use AppBundle\Form\DTP\MatchType;
use AppBundle\Service\DtpService;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MatchController extends Controller
{

    /**
     * @Route("/round/{roundId}/matches/{matchId}", name="dtp.round.matches")
     *
     * @param Request $request
     * @param int $roundId
     * @param null $matchId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function roundMatchesAction(Request $request, int $roundId, $matchId = null) {

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager('dtp');

        /** @var Round $round */
        $round = $em->find("DTP:Round", $roundId);
        $matches = $round->getMatches();

        return $this->render('dtp/backend/round/edit.html.twig', [
            'round' => $round,
            'matches' => $matches,
            'matchId' => $matchId
        ]);
    }

    /**
     * @Route("/match/edit/round/{roundId}/match/{matchId}", name="dtp.match.edit")
     *
     * @param Request $request
     * @param int $roundId
     * @param int|null $matchId
     * @return Response
     */
    public function editAction(Request $request, int $roundId, $matchId = null)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager('dtp');

        if ($matchId === null) {
            $match = new Match();
        } else {
            $match = $em->find('DTP:Match', $matchId);
        }

        $form = $this->createForm(MatchType::class, $match,['action' => $this->generateUrl('dtp.match.edit',
            [
                'roundId' => $roundId,
                'matchId' => $matchId
            ]
        )]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // new match?
            if ($match->getId() == null) {
                // update foreign keys
                $match->setRound($em->getReference('DTP:Round', $roundId));

                // update nr
                $dql = 'SELECT MAX(m.id) FROM DTP:Match m WHERE m.roundId = ?1';
                $nr = $em->createQuery($dql)
                        ->setParameter(1, $roundId)
                        ->getSingleScalarResult() + 1;
                $match->setNr($nr);

                $msg = 'Spiel Nummer <b>' . $nr . '</b> wurde hinzugefügt.';
            } else {
                $msg = 'Spiel Nummer <b>' . $match->getNr() . '</b> wurde aktualisiert.';
            }

            $em->persist($match);
            $em->flush();

            $this->addFlash('success', $msg);
            return $this->redirectToRoute('dtp.round.matches', ['roundId' => $roundId]);
        }

        return $this->render('dtp/backend/match/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
