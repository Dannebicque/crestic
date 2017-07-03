<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PublicMembresController
 * @package AppBundle\Controller
 * @Route("/membres")
 */
class PublicMembresController extends Controller
{
    /**
     * @Route("/", name="public_membres")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:PublicMembres:index.html.twig', array(// ...
        ));
    }

    /**
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/profil/{slug}", name="public_membres_profil")
     */
    public function profilAction($slug)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findOneBy(array('slug' => $slug));

        return $this->render('@App/PublicMembres/profil.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/ajax/trombi", name="public_membres_trombi_lettre")
     */
    public function trombiLoadAction(Request $request)
    {
        $lettre = $request->request->get('lettre');
        if ($lettre != 'tous')
        {
            $membres = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findByLettre($lettre);
        } else
        {
            $membres = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAllMembresCrestic();
        }

        return $this->render('@App/PublicMembres/trombi.html.twig', array(
            'affichage' => $lettre,
            'membres'   => $membres,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/ajax/annuaire", name="public_membres_annuaire_lettre")
     */
    public function annuaireLoadAction(Request $request)
    {
        $lettre = $request->request->get('lettre');

        if ($lettre != 'tous')
        {
            $membres = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findByLettre($lettre);
        } else
        {
            $membres = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAllMembresCrestic();
        }

        return $this->render('@App/PublicMembres/annuaire.html.twig', array(
            'affichage' => $lettre,
            'membres'   => $membres,
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/ajax/liste", name="public_membres_liste")
     */
    public function listeLoadAction()
    {
        $membres = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAllMembresCrestic();

        $categories = array(
            array('code' => 'PR', 'libelle' => 'professeurs'),
            array('code' => 'MCF', 'libelle' => 'Maîtres de Conférences'),
            array('code' => 'CAS', 'libelle' => 'Chercheurs Associés'),
            array('code' => 'ING', 'libelle' => 'Ingénieurs et techniciens'),
            array('code' => 'PDOC', 'libelle' => 'Post-Doctorants'),
            array('code' => 'DOC', 'libelle' => 'Doctorants'),
            array('code' => 'ADM', 'libelle' => 'Personnels administratifs'),
        );

        return $this->render('@App/PublicMembres/liste.html.twig', array(
            'membres'    => $membres,
            'categories' => $categories,
        ));
    }
}
