<?php

namespace AppBundle\Controller\Dtp\Backend;

use AppBundle\Entity\DTP\League;
use AppBundle\Form\DTP\LeagueType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LeagueController extends Controller
{
    /**
     * @Route("/league/create", name="dtp.league.create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $league = new League();
        $form = $this->createForm(LeagueType::class, $league);

        if ($request->isXmlHttpRequest()) {
            $form->remove('saveAndAdd');
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager('dtp');
            $em->persist($league);
            $em->flush();

            $msg = $form->get('name')->getData() . ' wurde hinzugefügt.';
            if ($request->isXmlHttpRequest()) {
                return $this->json(["msg"=>$msg]);
            } else {
                $this->addFlash('success', $msg);
                $nextAction = $form->get('saveAndAdd')->isClicked()
                    ? 'dtp.league.create'
                    : 'dtp.dashboard';

                return $this->redirectToRoute($nextAction);
            }
        }

        return $this->render('dtp/backend/league/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}