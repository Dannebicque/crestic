<?php

namespace AppBundle\Controller\Administration;

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
 * @Route("administration/equipes")
 */
class EquipesController extends Controller
{
    /**
     * Lists all equipe entities.
     *
     * @Route("/", name="administration_equipes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipes = $em->getRepository('AppBundle:Equipes')->findAll();

        return $this->render('@App/Administration/equipes/index.html.twig', array(
            'equipes' => $equipes,
        ));
    }

    /**
     * Creates a new equipe entity.
     *
     * @Route("/new", name="administration_equipes_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $equipe = new Equipes();
        $form   = $this->createForm('AppBundle\Form\EquipesType', $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush();

            return $this->redirectToRoute('administration_equipes_show', array('id' => $equipe->getId()));
        }

        return $this->render('@App/Administration/equipes/new.html.twig', array(
            'equipe' => $equipe,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipe entity.
     *
     * @Route("/{id}", name="administration_equipes_show")
     * @Method("GET")
     * @param Equipes $equipe
     * @return Response
*/
    public function showAction(Equipes $equipe)
    {
        $deleteForm = $this->createDeleteForm($equipe);

        return $this->render('@App/Administration/equipes/show.html.twig', array(
            'equipe'      => $equipe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipe entity.
     *
     * @Route("/{id}/edit", name="administration_equipes_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Equipes $equipe
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
*/
    public function editAction(Request $request, Equipes $equipe)
    {
        $editForm = $this->createForm('AppBundle\Form\EquipesType', $equipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_equipes_edit', array('id' => $equipe->getId()));
        }

        return $this->render('@App/Administration/equipes/edit.html.twig', array(
            'equipe'    => $equipe,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a equipe entity.
     *
     * @Route("/{id}", name="administration_equipes_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Equipes $equipe
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, Equipes $equipe)
    {
        $form = $this->createDeleteForm($equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipe);
            $em->flush();
        }

        return $this->redirectToRoute('administration_equipes_index');
    }

    /**
     * Creates a form to delete a equipe entity.
     *
     * @param Equipes $equipe The equipe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipes $equipe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_equipes_delete', array('id' => $equipe->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param Equipes $id
     * @Route("/{id}/membres", name="administration_equipes_options")
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

        return $this->render('@App/Administration/equipes/options.html.twig', array(
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
     * @Route("/ajax/membre", name="administration_equipes_ajax_membre", methods={"POST"})
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
     * @Route("/ajax/membrer", name="administration_equipes_ajax_membre_remove", methods={"POST"})
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
     * @Route("/ajax/projet", name="administration_equipes_ajax_projet", methods={"POST"})
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
     * @Route("/ajax/projetr", name="administration_equipes_ajax_projet_remove", methods={"POST"})
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
     * @Route("/ajax/departement", name="administration_equipes_ajax_departement", methods={"POST"})
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
     * @Route("/ajax/departementr", name="administration_equipes_ajax_departement_remove", methods={"POST"})
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
     * @Route("/ajax/slider", name="administration_equipes_ajax_slider", methods={"POST"})
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
     * @Route("/ajax/sliderr", name="administration_equipes_ajax_slider_remove", methods={"POST"})
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
