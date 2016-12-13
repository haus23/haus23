<?php

namespace AppBundle\Controller\Dtp\Backend;

use AppBundle\Service\DtpService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="dtp.dashboard")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        /** @var DtpService $dtp */
        $dtp = $this->get('dtp');

        return $this->render('dtp/backend/dashboard.html.twig', [
            'tournament' => $dtp->getTournament()
        ]);
    }

    /**
     * @Route("/add-match", name="dtp.dashboard.match")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addMatchAction()
    {
        return $this->render('dtp/backend/dashboard/add-match.html.twig');
    }
}
