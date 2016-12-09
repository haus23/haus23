<?php

namespace AppBundle\Controller\Dtp\Backend;

use AppBundle\Entity\DTP\Ruleset;
use AppBundle\Entity\DTP\Tournament;
use AppBundle\Form\DTP\RulesetType;
use AppBundle\Form\DTP\TournamentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
}