<?php

namespace AppBundle\Controller\Dtp\Backend;

use AppBundle\Entity\DTP\Match;
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
     * @Route("/match/create", name="dtp.match.create")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var DtpService $dtp */
            $dtp = $this->get('dtp');

            $round = $dtp->getRound();

            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager('dtp');

            // update foreign keys
            $match->setTournament($em->getReference('DTP:Tournament', $round->getTournamentId()));
            $match->setRound($em->getReference('DTP:Round', $round->getId()));

            // update nr
            $dql = 'SELECT MAX(m.id) FROM DTP:Match m WHERE m.tournamentId = ?1';
            $nr = $em->createQuery($dql)
                    ->setParameter(1, $round->getTournamentId())
                    ->getSingleScalarResult() + 1;
            $match->setNr($nr);

            $em->persist($match);
            $em->flush();

            $msg = 'Spiel Nummer <b>' . $nr . '</b> wurde hinzugefügt.';
            return $this->json(["msg"=>$msg, "data" => $match]);
        }

        return $this->render('dtp/backend/match/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/match/update/{id}", name="dtp.match.update")
     *
     * @param Request $request
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager('dtp');
        /** @var Match $match */
        $match = $em->find('DTP:Match',$id);

        if (!$match) {
            throw $this->createNotFoundException(
                'No match found for id '.$id
            );
        }

        $form = $this->createForm(MatchType::class, $match);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($match);
            $em->flush();

            $msg = 'Spiel Nummer <b>' . $match->getNr() . '</b> wurde aktualisiert.';
            return $this->json(["msg"=>$msg, "data" => $match]);
        }

        return $this->render('dtp/backend/match/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
