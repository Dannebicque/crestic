<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Publications;
use AppBundle\Repository\PublicationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PublicationsController
 * @package AppBundle\Controller
 * @Route("administration/publications")
 */
class PublicationsController extends Controller
{
    /**
     * @Route("/", name="administration_publications_index")
     */
    public function indexAction()
    {

        $membresCrestic = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAll();
        return $this->render('AppBundle:Administration/Publications:index.html.twig', array(
            'membresCrestic' => $membresCrestic,
        ));
    }

    /**
     * @Route("/new", name="administration_publications_new")
     */
    public function newAction(Request $request)
    {
        return $this->render('AppBundle:Administration/Publications:new.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/delete", name="administration_publications_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request)
    {
        return $this->render('AppBundle:Administration/Publications:delete.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/edit/{id}", name="administration_publications_edit")
     */
    public function editAction(Request $request, Publications $id)
    {
        return $this->render('AppBundle:Administration/Publications:edit.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/options/{id}", name="administration_publications_options")
     */
    public function optionsAction(Publications $id)
    {
        return $this->render('AppBundle:Administration/Publications:options.html.twig', array(// ...
        ));
    }

    /**
     * @param Request $request
     * @Route("/resultats", name="administration_publications_resultats", methods={"POST"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resultatsAction(Request $request)
    {
        $idauteur = $request->request->get('auteur');
        $type     = $request->request->get('type');

        $auteur = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($idauteur);
        if ($type == 'all' && $auteur !== null)
        {
            //trouver toutes les publications d'un auteur
            $publications = $this->getDoctrine()->getRepository('AppBundle:Publications')->findAllPublicationsFromMembre($idauteur);
        } elseif ($type != 'all' && $auteur !== null)
        {
            //trouver toutes les publications d'un type précis pour un auteur
            $publications = $this->getDoctrine()->getRepository('AppBundle:Publications')->findAllPublicationsFromMembre($idauteur);

        } else
        {
            $publications = null;
        }

        return $this->render('@App/Administration/Publications/resultats.html.twig', array(
            'auteur' => $auteur,
            'type' => $type,
            'publications' => $publications
        ));
    }

}
