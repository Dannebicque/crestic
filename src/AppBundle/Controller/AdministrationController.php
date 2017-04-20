<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @Route(path="/administration")
 */
class AdministrationController extends Controller
{
    /**
     * @Route(path="/", name="homepage_admin")
     */
    public function indexAction()
    {

        return $this->render('AppBundle:Administration:index.html.twig', [
        ]);
    }
}
