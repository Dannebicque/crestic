<?php

namespace AppBundle\Controller\Responsable;

use AppBundle\Entity\Equipes;
use AppBundle\Entity\EquipesHasDepartements;
use AppBundle\Entity\EquipesHasMembres;
use AppBundle\Entity\EquipesHasSliders;
use AppBundle\Entity\MembresCrestic;
use AppBundle\Entity\ProjetsHasEquipes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Equipe controller.
 *
 * @Route("/espace-responsable/equipes")
 */
class EquipesController extends Controller
{
    /**
     * Lists all equipe entities.
     *
     * @Route("/", name="responsable_equipes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $equipes = $em->getRepository('AppBundle:Equipes')->findAllEquipesResponsable($user->getId());

        return $this->render('@App/Responsable/equipes/index.html.twig', array(
            'equipes' => $equipes,
        ));
    }

    /**
     * Finds and displays a equipe entity.
     *
     * @Route("/{id}", name="responsable_equipes_show")
     * @Method("GET")
     */
    public function showAction(Equipes $equipe)
    {
        return $this->render('@App/Responsable/equipes/show.html.twig', array(
            'equipe'      => $equipe
        ));
    }

    /**
     * Displays a form to edit an existing equipe entity.
     *
     * @Route("/{id}/edit", name="responsable_equipes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Equipes $equipe)
    {
        $editForm = $this->createForm('AppBundle\Form\EquipesResponsableType', $equipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('responsable_equipes_edit', array('id' => $equipe->getId()));
        }

        return $this->render('@App/Responsable/equipes/edit.html.twig', array(
            'equipe'    => $equipe,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * @param Equipes $id
     * @Route("/{id}/membres", name="responsable_equipes_options")
     * @return Response
     */
    public function equipeOptionsAction(Equipes $id)
    {
        $t = array();

        /** @var EquipesHasMembres $membre */
        foreach ($id->getMembres() as $membre)
        {
            $t['membre'][$membre->getMembreCrestic()->getId()] = $membre;
        }

        /** @var EquipesHasDepartements $membre */
        foreach ($id->getDepartements() as $dpt)
        {
            $t['departements'][$dpt->getDepartement()->getId()] = $dpt;
        }

        /** @var EquipesHasSliders $membre */
        foreach ($id->getSliders() as $slide)
        {
            $t['slider'][$slide->getSlider()->getId()] = $slide;
        }

        /** @var ProjetsHasEquipes $membre */
        foreach ($id->getProjets() as $projet)
        {
            $t['projet'][$projet->getProjet()->getId()] = $projet;
        }

        return $this->render('@App/Responsable/equipes/options.html.twig', array(
            'equipe'       => $id,
            't'            => $t,
            'membres'      => $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAllMembresCrestic(),
            'projets'      => $this->getDoctrine()->getRepository('AppBundle:Projets')->findAllProjets(),
            'departements' => $this->getDoctrine()->getRepository('AppBundle:Departements')->findAllDepartements(),
            'sliders'      => $this->getDoctrine()->getRepository('AppBundle:Slider')->findAllSlider()
        ));
    }

    /**
     * @param Request $request
     * @return Response
     * @internal param Equipes $id
     * @Route("/ajax/membre", name="responsable_equipes_ajax_membre", methods={"POST"})
     */
    public function equipeMembreAjaxAction(Request $request)
    {
        $idequipe = $request->request->get('equipe');
        $idmembre = $request->request->get('membre');

        $equipe       = $this->getDoctrine()->getRepository('AppBundle:Equipes')->find($idequipe);
        $membre       = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($idmembre);
        $equipemembre = $this->getDoctrine()->getRepository('AppBundle:EquipesHasMembres')->findBy(array('membreCrestic' => $idmembre, 'equipe' => $idequipe));

        if ($equipe && $membre && count($equipemembre) == 0)
        {
            $e_m = new EquipesHasMembres();
            $e_m->setEquipe($equipe);
            $e_m->setMembreCrestic($membre);
            $em = $this->getDoctrine()->getManager();
            $em->persist($e_m);
            $em->flush();
            return new Response('ok', 200);
        } else
        {
            return new Response('nok', 500);
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @internal param Equipes $id
     * @Route("/ajax/membrer", name="responsable_equipes_ajax_membre_remove", methods={"POST"})
     */
    public function equipeMembreAjaxRemoveAction(Request $request)
    {
        $idequipe = $request->request->get('equipe');
        $idmembre = $request->request->get('membre');

        $equipemembre = $this->getDoctrine()->getRepository('AppBundle:EquipesHasMembres')->findBy(array('membreCrestic' => $idmembre, 'equipe' => $idequipe));


        $em = $this->getDoctrine()->getManager();
        foreach ($equipemembre as $e)
        {
            $em->remove($e);
        }
        $em->flush();
        return new Response('ok', 200);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/projet", name="responsable_equipes_ajax_projet", methods={"POST"})
     */
    public function equipeProjetAjaxAction(Request $request)
    {
        $idequipe = $request->request->get('equipe');
        $idprojet = $request->request->get('projet');

        $equipe       = $this->getDoctrine()->getRepository('AppBundle:Equipes')->find($idequipe);
        $projet       = $this->getDoctrine()->getRepository('AppBundle:Projets')->find($idprojet);
        $equipeprojet = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasEquipes')->findBy(array('projet' => $idprojet, 'equipe' => $idequipe));

        if ($equipe && $projet && count($equipeprojet) == 0)
        {
            $e_m = new ProjetsHasEquipes();
            $e_m->setEquipe($equipe);
            $e_m->setProjet($projet);
            $em = $this->getDoctrine()->getManager();
            $em->persist($e_m);
            $em->flush();
            return new Response('ok', 200);
        } else
        {
            return new Response('nok', 500);
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/projetr", name="responsable_equipes_ajax_projet_remove", methods={"POST"})
     */
    public function equipeProjetAjaxRemoveAction(Request $request)
    {
        $idequipe = $request->request->get('equipe');
        $idprojet = $request->request->get('projet');

        $equipeprojet = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasEquipes')->findBy(array('projet' => $idprojet, 'equipe' => $idequipe));


        $em = $this->getDoctrine()->getManager();
        foreach ($equipeprojet as $e)
        {
            $em->remove($e);
        }
        $em->flush();
        return new Response('ok', 200);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/departement", name="responsable_equipes_ajax_departement", methods={"POST"})
     */
    public function equipeDepartementAjaxAction(Request $request)
    {
        $idequipe      = $request->request->get('equipe');
        $iddepartement = $request->request->get('departement');

        $equipe            = $this->getDoctrine()->getRepository('AppBundle:Equipes')->find($idequipe);
        $departement       = $this->getDoctrine()->getRepository('AppBundle:Departements')->find($iddepartement);
        $equipedepartement = $this->getDoctrine()->getRepository('AppBundle:EquipesHasDepartements')->findBy(array('departement' => $iddepartement, 'equipe' => $idequipe));

        if ($equipe && $departement && count($equipedepartement) == 0)
        {
            $e_m = new EquipesHasDepartements();
            $e_m->setEquipe($equipe);
            $e_m->setDepartement($departement);
            $em = $this->getDoctrine()->getManager();
            $em->persist($e_m);
            $em->flush();
            return new Response('ok', 200);
        } else
        {
            return new Response('nok', 500);
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @internal param Equipes $id
     * @Route("/ajax/departementr", name="responsable_equipes_ajax_departement_remove", methods={"POST"})
     */
    public function equipeDepartementAjaxRemoveAction(Request $request)
    {
        $idequipe      = $request->request->get('equipe');
        $iddepartement = $request->request->get('departement');

        $equipedepartement = $this->getDoctrine()->getRepository('AppBundle:EquipesHasDepartements')->findBy(array('departement' => $iddepartement, 'equipe' => $idequipe));


        $em = $this->getDoctrine()->getManager();
        foreach ($equipedepartement as $e)
        {
            $em->remove($e);
        }
        $em->flush();
        return new Response('ok', 200);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/slider", name="responsable_equipes_ajax_slider", methods={"POST"})
     */
    public function equipeSliderAjaxAction(Request $request)
    {
        $idequipe = $request->request->get('equipe');
        $idslider = $request->request->get('slider');

        $equipe       = $this->getDoctrine()->getRepository('AppBundle:Equipes')->find($idequipe);
        $slider       = $this->getDoctrine()->getRepository('AppBundle:Slider')->find($idslider);
        $equipeslider = $this->getDoctrine()->getRepository('AppBundle:EquipesHasSliders')->findBy(array('slider' => $idslider, 'equipe' => $idequipe));

        if ($equipe && $slider && count($equipeslider) == 0)
        {
            $e_m = new EquipesHasSliders();
            $e_m->setEquipe($equipe);
            $e_m->setSlider($slider);
            $em = $this->getDoctrine()->getManager();
            $em->persist($e_m);
            $em->flush();
            return new Response('ok', 200);
        } else
        {
            return new Response('nok', 500);
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @internal param Equipes $id
     * @Route("/ajax/sliderr", name="responsable_equipes_ajax_slider_remove", methods={"POST"})
     */
    public function equipeSliderAjaxRemoveAction(Request $request)
    {
        $idequipe = $request->request->get('equipe');
        $idslider = $request->request->get('slider');

        $equipeslider = $this->getDoctrine()->getRepository('AppBundle:EquipesHasSliders')->findBy(array('slider' => $idslider, 'equipe' => $idequipe));


        $em = $this->getDoctrine()->getManager();
        foreach ($equipeslider as $e)
        {
            $em->remove($e);
        }
        $em->flush();
        return new Response('ok', 200);
    }
}
