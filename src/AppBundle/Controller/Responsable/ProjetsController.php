<?php

namespace AppBundle\Controller\Responsable;

use AppBundle\Entity\Projets;
use AppBundle\Entity\ProjetsHasEquipes;
use AppBundle\Entity\ProjetsHasFinanceurs;
use AppBundle\Entity\ProjetsHasMembres;
use AppBundle\Entity\ProjetsHasPartenaires;
use AppBundle\Entity\ProjetsHasPlateformes;
use AppBundle\Entity\ProjetsHasSliders;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Projet controller.
 *
 * @Route("/espace-responsable/projets")
 */
class ProjetsController extends Controller
{
    /**
     * Lists all projet entities.
     *
     * @Route("/", name="responsable_projets_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $projets = $em->getRepository('AppBundle:Projets')->findAllProjetsResponsable($user->getId());

        return $this->render('@App/Responsable/projets/index.html.twig', array(
            'projets' => $projets,
        ));
    }

    /**
     * Creates a new projet entity.
     *
     * @Route("/new", name="responsable_projets_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $projet = new Projets();
        $form = $this->createForm('AppBundle\Form\ProjetsResponsableType', $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $projet->setResponsable($this->getUser());
            $em->persist($projet);
            $em->flush();

            return $this->redirectToRoute('responsable_projets_show', array('id' => $projet->getId()));
        }

        return $this->render('@App/Responsable/projets/new.html.twig', array(
            'projet' => $projet,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projet entity.
     *
     * @Route("/{id}", name="responsable_projets_show")
     * @Method("GET")
     * @param Projets $projet
     *
     * @return Response
     */
    public function showAction(Projets $projet)
    {
        return $this->render('@App/Responsable/projets/show.html.twig', array(
            'projet' => $projet
        ));
    }

    /**
     * Displays a form to edit an existing projet entity.
     *
     * @Route("/{id}/edit", name="responsable_projets_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Projets $projet
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
*/
    public function editAction(Request $request, Projets $projet)
    {
        $editForm = $this->createForm('AppBundle\Form\ProjetsResponsableType', $projet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('responsable_projets_edit', array('id' => $projet->getId()));
        }

        return $this->render('@App/Responsable/projets/edit.html.twig', array(
            'projet'    => $projet,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * @param Projets $id
     * @Route("/{id}/projets", name="responsable_projets_options")
     *
     * @return Response
     */
    public function projetOptionsAction(Projets $id)
    {
        $t = array();

        /** @var ProjetsHasMembres $membre */
        foreach ($id->getMembres() as $membre) {
            $t['membres'][$membre->getMembreCrestic()->getId()] = $membre;
        }

        /** @var ProjetsHasSliders $slider */
        foreach ($id->getSliders() as $slider) {
            $t['sliders'][$slider->getSlider()->getId()] = $slider;
        }

        /** @var ProjetsHasEquipes $equipe */
        foreach ($id->getEquipes() as $equipe) {
            $t['equipes'][$equipe->getEquipe()->getId()] = $equipe;
        }

        /** @var ProjetsHasPlateformes $plateforme */
        foreach ($id->getPlateformes() as $plateforme) {
            $t['plateformes'][$plateforme->getPlateforme()->getId()] = $plateforme;
        }

        /** @var ProjetsHasPartenaires $partenaire */
        foreach ($id->getPartenaires() as $partenaire) {
            $t['partenaires'][$partenaire->getPartenaire()->getId()] = $partenaire;
        }

        /** @var ProjetsHasFinanceurs $financeur */
        foreach ($id->getFinanceurs() as $financeur) {
            $t['financeurs'][$financeur->getFinanceur()->getId()] = $financeur;
        }

        return $this->render('@App/Responsable/projets/options.html.twig', array(
            'projet'      => $id,
            't'           => $t,
            'membres'     => $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAllMembresCrestic(),
            'equipes'     => $this->getDoctrine()->getRepository('AppBundle:Equipes')->findAllEquipes(),
            'plateformes' => $this->getDoctrine()->getRepository('AppBundle:Plateformes')->findAllPlateformes(),
            'sliders'     => $this->getDoctrine()->getRepository('AppBundle:Slider')->findAllSlider(),
            'partenaires' => $this->getDoctrine()->getRepository('AppBundle:Partenaires')->findAllPartenaires(),
            'financeurs' => $this->getDoctrine()->getRepository('AppBundle:Financeurs')->findAllFinanceurs(),


        ));
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @Route("/ajax/add/option", name="responsable_projets_ajax_option_add", methods={"POST"})
     */
    public function projetOptionAjaxAction(Request $request)
    {
        $idprojet = $request->request->get('projet');
        $idoption = $request->request->get('idoption');
        $type = $request->request->get('type');


        $projet = $this->getDoctrine()->getRepository('AppBundle:Projets')->find($idprojet);

        switch ($type) {
            case 'membre':
                $option = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasMembres')->findBy(array(
                    'membreCrestic' => $idoption,
                    'projet'        => $idprojet
                ));
                $e_m = new ProjetsHasMembres();
                $set = 'setMembreCrestic';
                $texte = 'Membre associé au projet';
                break;
            case 'equipe':
                $option = $this->getDoctrine()->getRepository('AppBundle:Equipes')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasEquipes')->findBy(array(
                    'equipe' => $idoption,
                    'projet' => $idprojet
                ));
                $e_m = new ProjetsHasEquipes();
                $set = 'setEquipe';
                $texte = 'Equipe associée au projet';
                break;
            case 'partenaire':
                $option = $this->getDoctrine()->getRepository('AppBundle:Partenaires')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPartenaires')->findBy(array(
                    'partenaire' => $idoption,
                    'projet'     => $idprojet
                ));
                $e_m = new ProjetsHasPartenaires();
                $set = 'setPartenaire';
                $texte = 'Partenaire associé au projet';
                break;
            case 'financeur':
                $option = $this->getDoctrine()->getRepository('AppBundle:Financeurs')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasFinanceurs')->findBy(array(
                    'financeur' => $idoption,
                    'projet'    => $idprojet
                ));
                $e_m = new ProjetsHasFinanceurs();
                $set = 'setFinanceur';
                $texte = 'Financeur associé au projet';
                break;
            case 'slider':
                $option = $this->getDoctrine()->getRepository('AppBundle:Slider')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasSliders')->findBy(array(
                    'slider' => $idoption,
                    'projet' => $idprojet
                ));
                $e_m = new ProjetsHasSliders();
                $set = 'setSlider';
                $texte = 'Slide ajouté au projet';
                break;
            case 'plateforme':
                $option = $this->getDoctrine()->getRepository('AppBundle:Plateformes')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPlateformes')->findBy(array(
                    'plateforme' => $idoption,
                    'projet'     => $idprojet
                ));
                $e_m = new ProjetsHasPlateformes();
                $set = 'setPlateforme';
                $texte = 'Plateforme associée au projet';
                break;
            default:
                $e_m = null;
                $option = false;
                $projetoption = null;
                $texte = 'Erreur';
                $set = '';
        }


        if ($projet && $option && count($projetoption) == 0 && $e_m !== null) {
            $e_m->setProjet($projet);
            $e_m->$set($option);
            $em = $this->getDoctrine()->getManager();
            $em->persist($e_m);
            $em->flush();

            return new Response($texte, 200);
        }

        return new Response('Erreur lors de la modification des options du projet', 500);

    }

    /**
     * @param Request $request
     *
     * @return Response
     * @Route("/ajax/remove/option", name="responsable_projets_ajax_option_remove", methods={"POST"})
     */
    public function projetMembreAjaxRemoveAction(Request $request)
    {
        $idprojet = $request->request->get('projet');
        $idoption = $request->request->get('idoption');
        $type = $request->request->get('type');


        $projet = $this->getDoctrine()->getRepository('AppBundle:Projets')->find($idprojet);

        switch ($type) {
            case 'membre':
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasMembres')->findBy(array(
                    'membreCrestic' => $idoption,
                    'projet'        => $idprojet
                ));
                $texte = 'Membre retiré du projet';
                break;
            case 'equipe':
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasEquipes')->findBy(array(
                    'equipe' => $idoption,
                    'projet' => $idprojet
                ));
                $texte = 'Equipe retirée du projet';
                break;
            case 'partenaire':
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPartenaires')->findBy(array(
                    'partenaire' => $idoption,
                    'projet'     => $idprojet
                ));
                $texte = 'Partenaire retiré du projet';
                break;
            case 'financeur':
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasFinanceurs')->findBy(array(
                    'financeur' => $idoption,
                    'projet'    => $idprojet
                ));
                $texte = 'Financeur retiré du projet';
                break;
            case 'slider':
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasSliders')->findBy(array(
                    'slider' => $idoption,
                    'projet' => $idprojet
                ));
                $texte = 'Slide retiré du projet';
                break;
            case 'plateforme':
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPlateformes')->findBy(array(
                    'plateforme' => $idoption,
                    'projet'     => $idprojet
                ));
                $texte = 'Plateforme retirée du projet';
                break;
            default:
                $projetoption = null;
                $texte = 'Rien à retirer';
                break;
        }


        if (count($projetoption) > 0) {
            $em = $this->getDoctrine()->getManager();
            foreach ($projetoption as $p) {
                $em->remove($p);
            }
            $em->flush();

            return new Response($texte, 200);
        }

        return new Response('Erreur lors de la modification des options du projet', 500);

    }
}
