<?php

namespace AppBundle\Controller\Responsable;

use AppBundle\Entity\Plateformes;
use AppBundle\Entity\PlateformesHasSliders;
use AppBundle\Entity\ProjetsHasPlateformes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Plateforme controller.
 *
 * @Route("/espace-responsable/plateformes")
 */
class PlateformesController extends Controller
{
    /**
     * Lists all plateforme entities.
     *
     * @Route("/", name="responsable_plateformes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plateformes = $em->getRepository('AppBundle:Plateformes')->findAll();

        return $this->render('@App/Responsable/plateformes/index.html.twig', array(
            'plateformes' => $plateformes,
        ));
    }

    /**
     * Creates a new plateforme entity.
     *
     * @Route("/new", name="responsable_plateformes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plateforme = new Plateformes();
        $form       = $this->createForm('AppBundle\Form\PlateformesType', $plateforme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plateforme);
            $em->flush();

            return $this->redirectToRoute('responsable_plateformes_show', array('id' => $plateforme->getId()));
        }

        return $this->render('@App/Responsable/plateformes/new.html.twig', array(
            'plateforme' => $plateforme,
            'form'       => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plateforme entity.
     *
     * @Route("/{id}", name="responsable_plateformes_show")
     * @Method("GET")
     */
    public function showAction(Plateformes $plateforme)
    {
        $deleteForm = $this->createDeleteForm($plateforme);

        return $this->render('@App/Responsable/plateformes/show.html.twig', array(
            'plateforme'  => $plateforme,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plateforme entity.
     *
     * @Route("/{id}/edit", name="responsable_plateformes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Plateformes $plateforme)
    {
        $editForm = $this->createForm('AppBundle\Form\PlateformesType', $plateforme);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('responsable_plateformes_edit', array('id' => $plateforme->getId()));
        }

        return $this->render('@App/Responsable/plateformes/edit.html.twig', array(
            'plateforme' => $plateforme,
            'edit_form'  => $editForm->createView(),
        ));
    }

    /**
     * Deletes a plateforme entity.
     *
     * @Route("/{id}", name="responsable_plateformes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Plateformes $plateforme)
    {
        $form = $this->createDeleteForm($plateforme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plateforme);
            $em->flush();
        }

        return $this->redirectToRoute('responsable_plateformes_index');
    }

    /**
     * Creates a form to delete a plateforme entity.
     *
     * @param Plateformes $plateforme The plateforme entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Plateformes $plateforme)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('responsable_plateformes_delete', array('id' => $plateforme->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param Plateformes $id
     * @Route("/{id}/plateformes", name="responsable_plateformes_options")
     * @return Response
     */
    public function plateformeOptionsAction(Plateformes $id)
    {
        $t = array();

        /** @var ProjetsHasPlateformes $membre */
        foreach ($id->getProjets() as $projet)
        {
            $t['projets'][$projet->getProjet()->getId()] = $projet;
        }

        /** @var PlateformesHasSliders $slider */
        foreach ($id->getSliders() as $slider)
        {
            $t['sliders'][$slider->getSlider()->getId()] = $slider;
        }


        return $this->render('@App/Responsable/plateformes/options.html.twig', array(
            'plateforme' => $id,
            't'          => $t,
            'projets'    => $this->getDoctrine()->getRepository('AppBundle:Projets')->findAllProjets(),
            'sliders'    => $this->getDoctrine()->getRepository('AppBundle:Slider')->findAllSlider(),
        ));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/options/add", name="responsable_plateformes_ajax_option_add", methods={"POST"})
     */
    public function plateformeOptionAjaxAction(Request $request)
    {
        $idplateforme = $request->request->get('plateforme');
        $idoption     = $request->request->get('idoption');
        $type         = $request->request->get('type');


        $projet = $this->getDoctrine()->getRepository('AppBundle:Plateformes')->find($idplateforme);

        switch ($type)
        {
            case 'slider':
                $option       = $this->getDoctrine()->getRepository('AppBundle:Slider')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:PlateformesHasSliders')->findBy(array('slider' => $idoption, 'plateforme' => $idplateforme));
                $e_m          = new PlateformesHasSliders();
                $set          = 'setSlider';
                $texte        = 'Slide ajouté à la plateforme';
                break;
            case 'projet':
                $option       = $this->getDoctrine()->getRepository('AppBundle:Projets')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPlateformes')->findBy(array('plateforme' => $idplateforme, 'projet' => $idoption));
                $e_m          = new ProjetsHasPlateformes();
                $set          = 'setProjet';
                $texte        = 'Projet associé à la plateforme';
                break;
            default:
                $option       = false;
                $projetoption = null;
                $e_m          = null;
                $texte        = '';
                $set          = '';
        }


        if ($projet && $option && count($projetoption) == 0 && $e_m !== null && $set != '')
        {
            $e_m->setPlateforme($projet);
            $e_m->$set($option);
            $em = $this->getDoctrine()->getManager();
            $em->persist($e_m);
            $em->flush();
            return new Response($texte, 200);
        } else
        {
            return new Response('Erreur lors de la modification des options de la plateforme', 500);
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/options/remove", name="responsable_plateforme_ajax_option_remove", methods={"POST"})
     */
    public function plateformeAjaxRemoveAction(Request $request)
    {
        $idplateforme = $request->request->get('plateforme');
        $idoption     = $request->request->get('idoption');
        $type         = $request->request->get('type');


        $plateforme = $this->getDoctrine()->getRepository('AppBundle:Plateformes')->find($idplateforme);

        switch ($type)
        {
            case 'projet':
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPlateformes')->findBy(array('plateforme' => $idplateforme, 'projet' => $idoption));
                $texte        = 'Suppression d\'un projet associé à la plateforme';
                break;
            case 'slider':
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:PlateformesHasSliders')->findBy(array('slider' => $idoption, 'plateforme' => $idplateforme));
                $texte        = 'Suppression d\'un slide associé à la plateforme';
                break;
            default:
                $projetoption = null;
                $texte        = 'erreur';
                break;
        }


        if ($plateforme && count($projetoption) > 0)
        {
            $em = $this->getDoctrine()->getManager();
            foreach ($projetoption as $e)
            {
                $em->remove($e);
            }
            $em->flush();
            return new Response($texte, 200);
        } else
        {
            return new Response('Erreur lors de la modification des options de la plateforme', 500);
        }
    }
}
