<?php

namespace AppBundle\Controller\Dtp\Backend;

use AppBundle\Entity\DTP\Player;
use AppBundle\Form\DTP\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlayerController extends Controller
{
    /**
     * @Route("/player/create", name="dtp.player.create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);

        if ($request->isXmlHttpRequest()) {
            $form->remove('saveAndAdd');
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager('dtp');
            $em->persist($player);
            $em->flush();

            $msg = 'Spieler <b>' . $form->get('name')->getData() . '</b> wurde hinzugefügt.';
            if ($request->isXmlHttpRequest()) {
                return $this->json(["msg"=>$msg]);
            } else {
                $this->addFlash('success', $msg);
                $nextAction = $form->get('saveAndAdd')->isClicked()
                    ? 'dtp.player.create'
                    : 'dtp.dashboard';

                return $this->redirectToRoute($nextAction);
            }
        }

        return $this->render('dtp/backend/player/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}