<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $page = $this->getDoctrine()->getRepository('AppBundle:Cms')->findOneBy(array('slug' => 'presentation'));

        return $this->render('AppBundle:Default:index.html.twig', [
            'page' => $page
        ]);
    }

    public function menuAlternatifAction()
    {
        $equipes = $this->getDoctrine()->getRepository('AppBundle:Equipes')->findAllEquipesActives();
        $departements = $this->getDoctrine()->getRepository('AppBundle:Departements')->findAll();
        $plateformes = $this->getDoctrine()->getRepository('AppBundle:Plateformes')->findAll();
        $projets = $this->getDoctrine()->getRepository('AppBundle:Projets')->findAll();


        return $this->render('AppBundle:Default:menuAlternatif.html.twig', array(
            'equipes'      => $equipes,
            'departements' => $departements,
            'plateformes'  => $plateformes,
            'projets'      => $projets

        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/organigramme", name="public_organigramme")
     */
    public function organigrammeAction()
    {
        $result = array(
            'directeur'                 => $this->getDoctrine()->getRepository('AppBundle:Organigramme')->findAllOrganigramme('Directeur'),
            'directeurAdjoint'          => $this->getDoctrine()->getRepository('AppBundle:Organigramme')->findAllOrganigramme('Directeur Adjoint'),
            'conseilLaboratoire'        => $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAllConseilLaboratoire(),
            'departement'               => $this->getDoctrine()->getRepository('AppBundle:Departements')->findAllDepartements(),
            'equipe'                    => $this->getDoctrine()->getRepository('AppBundle:Equipes')->findAllEquipes(),
            'secretaire'                => $this->getDoctrine()->getRepository('AppBundle:Organigramme')->findAllOrganigramme('Secrétaire'),
            'assistante'                => $this->getDoctrine()->getRepository('AppBundle:Organigramme')->findAllOrganigramme('assistante'),
            'technicien'                => $this->getDoctrine()->getRepository('AppBundle:Organigramme')->findAllOrganigramme('Technicien'),
        );

        return $this->render('@App/Default/organigramme.html.twig', [
            'organigramme' => $result
        ]);
    }

    /**
     * @param $slug
     * @route("/page/{slug}", name="visiteur_page")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pageAction($slug)
    {

        $page = $this->getDoctrine()->getRepository('AppBundle:Cms')->findOneBy(array('slug' => $slug));

        return $this->render('AppBundle:Default:page.html.twig', [
            'page' => $page
        ]);

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/contact", name="public_contact")
     */
    public function contactAction()
    {
        $sites = $this->getDoctrine()->getRepository('AppBundle:Sites')->findAll();

        return $this->render('@App/Default/contact.html.twig', [
            'sites' => $sites
        ]);
    }

    /**
     * @param Request $request
     * @Route("/contact/send", name="public_contact_SendMessage")
     */
    public function contactSendMessageAction(Request $request)
    {

    }
}
