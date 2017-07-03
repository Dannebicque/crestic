<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

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
        $equipes           = $this->getDoctrine()->getManager()->getRepository('AppBundle:Equipes')->findAll();
        $projets           = $this->getDoctrine()->getManager()->getRepository('AppBundle:Projets')->findAll();
        $departements      = $this->getDoctrine()->getManager()->getRepository('AppBundle:Departements')->findAll();
        $countpublications = $this->getDoctrine()->getRepository('AppBundle:Publications')->count();


        return $this->render('AppBundle:PublicPublications:index.html.twig', array(
            'equipes'      => $equipes,
            'projets'      => $projets,
            'departements' => $departements,
            'nbpublis'     => $countpublications,
        ));
    }

    /**
     * @Route("/show/{id}", name="public_publication_show")
     */
    public function showAction($id)
    {


        return $this->render('AppBundle:PublicPublications:show.html.twig', array());
    }

    /**
     * @param Request $request
     * @Route("/search", name="public_publications_search", methods={"POST"})
     */
    public function searchAction(Request $request)
    {
        $equipe          = $request->request->get('equipe');
        $projet          = $request->request->get('projet');
        $departement     = $request->request->get('departement');
        $typePublication = $request->request->get('typePublication');
        $auteur          = $request->request->get('auteur');
        $keywords        = $request->request->get('keywords');
        $dateDebut       = $request->request->get('dateDebut');
        $dateFin         = $request->request->get('dateFin');

        $critere = ''; //todo: liste des critères

        // jsute le type.
        $publications = $this->getDoctrine()->getRepository('AppBundle:' . $typePublication)->findAll();

        $nb = count($publications);
        $t  = array();
        for ($i = 2004; $i <= date('Y'); $i++)
        {
            $t[$i] = array();
        }
        $t[0] = array();

        foreach ($publications as $p)
        {
            $t[$p->getAnneePublication()][] = $p;
        }

        return $this->render('@App/PublicPublications/resultat_recherche.html.twig', array(
            'publications' => $t,
            'criteres'     => $critere,
            'nbresult'     => $nb
        ));
    }

    /**
     * @param Request $request
     * @Route("ajax/bibtex", name="public_publication_ajax_bibtex")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bibTexAction(Request $request)
    {
        $idPublication = $request->request->get('publication');
        $publication   = $this->getDoctrine()->getRepository('AppBundle:Publications')->find($idPublication);

        if ($publication)
        {
            return $this->render('@App/PublicPublications/bibtex.html.twig', array(
                'publication' => $publication
            ));
        } else
        {
            return $this->render('@App/PublicPublications/bibtex.html.twig', array(
                'publication' => null
            ));
        }
    }
}
