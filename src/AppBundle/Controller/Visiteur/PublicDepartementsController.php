<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PublicDepartementsController
 * @package AppBundle\Controller
 * @Route("/departement")
 */
class PublicDepartementsController extends Controller
{
    /**
     *
     * @Route("/", name="public_departements")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:PublicDepartements:index.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/{slug}", name="public_departement")
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function voirAction($slug)
    {
        $departement = $this->getDoctrine()->getRepository('AppBundle:Departements')->findOneBy(array('slug' => $slug));
        $equipes     = $this->getDoctrine()->getRepository('AppBundle:EquipesHasDepartements')->findAllEquipesFromDepartement($departement->getId());
        return $this->render('AppBundle:PublicDepartements:voir.html.twig', array(
            'departement' => $departement,
            'equipes'     => $equipes
        ));
    }

}
