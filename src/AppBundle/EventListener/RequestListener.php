<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        // Redirect any backend request without current tournament in session to the dashboard
        $controller = $event->getRequest()->get('_controller');
        $route = $event->getRequest()->get('_route');

        $allowedRoutes = ['dtp.dashboard', 'dtp.tournament.create', 'dtp.ruleset.create'];
        if (strpos($controller,'Dtp\\Backend') === false || in_array($route, $allowedRoutes)) {
            return;
        }

        $session = $event->getRequest()->getSession();
        if (!$session->has('dtp.backend.tournament')) {
            $event->setResponse(new RedirectResponse('/tipprunde/admin'));
        }
    }
}
