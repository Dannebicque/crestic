<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PublicEmploisController
 * @package AppBundle\Controller
 * @Route("/emplois")
 */
class PublicEmploisController extends Controller
{
    /**
     * @Route("/", name="public_emploi")
     */
    public function indexAction()
    {
        $offres = $this->getDoctrine()->getRepository('AppBundle:Emplois')->findAll();
        return $this->render('AppBundle:PublicEmplois:index.html.twig', array(
            'offres' => $offres
        ));
    }

}
