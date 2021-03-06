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

class RoundController extends Controller
{
    /**
     * @Route("/round/create", name="dtp.round.create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        /** @var DtpService $dtp */
        $dtp = $this->get('dtp');

        $lastRound = $dtp->getRound();

        $nr = 1;
        if ($lastRound !== null) {
            $nr = $lastRound->getNr() + 1;
        }

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager('dtp');

            $tournament = $em->find("DTP:Tournament", $dtp->getTournament()->getId());

            $round = new Round();
            $round->setNr($nr);
            $round->setTournament($tournament);

            $em->persist($round);
            $em->flush();

            $msg = "Neue Runde $nr angelegt";
            $this->addFlash('success', $msg);
            return $this->json(['redirect' => $this->generateUrl('dtp.round.edit', ['id' => $round->getId()])]);
        }

        return $this->render('dtp/backend/round/create.html.twig', array(
            'nr' => $nr
        ));
    }
}
