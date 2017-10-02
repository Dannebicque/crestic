<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MembresCrestic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ResponsableController
 * @Route(path="/espace-responsable")
 */
class ResponsableController extends Controller
{
    /**
     * @Route(path="/", name="homepage_responsable")
     */
    public function indexAction()
    {
        /** @var MembresCrestic $user */
        $user      = $this->getUser();


        return $this->render('AppBundle:Responsable:index.html.twig', [
            'user'      => $user,
        ]);
    }
}
