<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PublicPublicationsController
 * @package AppBundle\Controller
 * @Route("/publications")
 */
class PublicPublicationsController extends Controller
{
    /**
     * @Route("/", name="public_publications")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:PublicPublications:index.html.twig', array(
            // ...
        ));
    }

}
