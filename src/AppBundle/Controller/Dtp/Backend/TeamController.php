<?php

namespace AppBundle\Controller\Dtp\Backend;

use AppBundle\Entity\DTP\Team;
use AppBundle\Form\DTP\TeamType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
    /**
     * @Route("/team/create", name="dtp.team.create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);

        if ($request->isXmlHttpRequest()) {
            $form->remove('saveAndAdd');
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager('dtp');
            $em->persist($team);
            $em->flush();

            $msg = 'Mannschaft <b>' . $form->get('name')->getData() . '</b> wurde hinzugefügt.';
            if ($request->isXmlHttpRequest()) {
                return $this->json(["msg"=>$msg, "data"=>["id"=>$team->getId(),"text"=>$team->getName()]]);
            } else {
                $this->addFlash('success', $msg);
                $nextAction = $form->get('saveAndAdd')->isClicked()
                    ? 'dtp.team.create'
                    : 'dtp.dashboard';

                return $this->redirectToRoute($nextAction);
            }
        }

        return $this->render('dtp/backend/team/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}