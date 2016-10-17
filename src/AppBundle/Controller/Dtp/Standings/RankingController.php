<?php

namespace AppBundle\Controller\Dtp\Standings;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RankingController extends Controller
{
    /**
     * @Route("/tipprunde/", name="ranking")
     */
    public function indexAction()
    {
        return $this->render('dtp/standings/ranking.html.twig');
    }
}
