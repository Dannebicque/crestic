<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PublicActualitesController
 * @package AppBundle\Controller
 * @Route("/actualites")
 */
class PublicActualitesController extends Controller
{
    /**
     * @Route("/", name="public_actualites")
     */
    public function indexAction()
    {
        $actualites = $this->getDoctrine()->getRepository('AppBundle:Actualites')->findPagination(0, 6);
        return $this->render('AppBundle:PublicActualites:index.html.twig', array(
            'actualites' => $actualites
        ));
    }

    /**
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{slug}", name="public_actualites_show")
     */
    public function showAction($slug)
    {
        $actualite = $this->getDoctrine()->getRepository('AppBundle:Actualites')->findOneBy(array('slug' => $slug));

        return $this->render('AppBundle:PublicActualites:show.html.twig', [
            'actualite' => $actualite
        ]);
    }

}
