<?php

namespace AppBundle\Controller\Dtp\Backend;

use AppBundle\Entity\DTP\Ruleset;
use AppBundle\Form\DTP\RulesetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RulesetController extends Controller
{
    /**
     * @Route("/ruleset/create", name="dtp.ruleset.create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $ruleset = new Ruleset();
        $form = $this->createForm(RulesetType::class, $ruleset);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager('dtp');
            $em->persist($ruleset);
            $em->flush();

            $msg = 'Regelwerk <b>' . $form->get('name')->getData() . '</b> wurde hinzugefügt.';
            if ($request->isXmlHttpRequest()) {
                return $this->json(["msg"=>$msg, "ruleset" => $ruleset]);
            } else {
                $this->addFlash('success', $msg);
                return $this->redirectToRoute('dtp.dashboard');
            }
        }

        return $this->render('dtp/backend/ruleset/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}