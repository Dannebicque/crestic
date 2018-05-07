<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Publications;
use AppBundle\Entity\PublicationsConferences;
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
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        return $this->render('AppBundle:Administration/Publications:new.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/delete", name="administration_publications_delete", methods={"DELETE"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function deleteAction(Request $request)
    {
        return $this->render('AppBundle:Administration/Publications:delete.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/edit/{id}", name="administration_publications_edit")
     * @param Request      $request
     * @param Publications $id
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Publications $id)
    {
        return $this->render('AppBundle:Administration/Publications:edit.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/options/{id}", name="administration_publications_options")
     * @param Publications $id
     * @return \Symfony\Component\HttpFoundation\Response
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
        if ($type === 'all' && $auteur !== null)
        {
            //trouver toutes les publications d'un auteur
            $publications = $this->getDoctrine()->getRepository('AppBundle:Publications')->findAllPublicationsFromMembre($idauteur);
        } elseif ($type !== 'all' && $auteur !== null)
        {
            //trouver toutes les publications d'un type précis pour un auteur
            $publications = $this->getDoctrine()->getRepository('AppBundle:Publications')->findAllPublicationsFromMembre($idauteur);

        } else
        {
            $publications = null;
        }

        return $this->render('@App/Administration/Publications/resultats.html.twig', array(
            'auteur'       => $auteur,
            'type'         => $type,
            'publications' => $publications
        ));
    }

    /**
     * Route("/updateconf")
     *
     */
//    public function updateConfPubliAction()
//    {
//        //todo: supprimer en prod...
//        $publications = $this->getDoctrine()->getRepository('AppBundle:PublicationsConferences')->findAll();
//        $em = $this->getDoctrine()->getManager();
//
//        /** @var PublicationsConferences $p */
//        foreach ($publications as $p)
//        {
//            if ($p->getConference() !== null) {
//                $p->setDateDebut($p->getConference()->getDateDebut());
//                $p->setDateFin($p->getConference()->getDateFin());
//                $p->setPays($p->getConference()->getPays());
//                $p->setEditeur($p->getConference()->getEditeur());
//                $p->setVille($p->getConference()->getVille());
//                $p->setUrlConference($p->getConference()->getUrl());
//                $p->setTauxSelection($p->getConference()->getTauxSelection());
//                $em->persist($p);
//            }
//        }
//        $em->flush();
//    }

}
