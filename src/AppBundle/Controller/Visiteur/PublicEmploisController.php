<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $offres = $this->getDoctrine()->getRepository('AppBundle:Emplois')->findBy(array(), array('created'=>'DESC'));
        return $this->render('AppBundle:PublicEmplois:index.html.twig', array(
            'offres' => $offres
        ));
    }

    /**
     * @Route("/ajax", name="public_emploi_details")
     */
    public function detailAction(Request $request)
    {
        $offre = $this->getDoctrine()->getRepository('AppBundle:Emplois')->find($request->request->get('offre'));
        return $this->render('AppBundle:PublicEmplois:detail.html.twig', array(
            'offre' => $offre
        ));
    }

}
