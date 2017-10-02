<?php

namespace AppBundle\Controller\Responsable;

use AppBundle\Entity\Slider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Slider controller.
 *
 * @Route("responsable/slider")
 */
class SliderController extends Controller
{
    /**
     * Lists all slider entities.
     *
     * @Route("/", name="responsable_slider_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sliders = $em->getRepository('AppBundle:Slider')->findAll();

        return $this->render('@App/Responsable/slider/index.html.twig', array(
            'sliders' => $sliders,
        ));
    }

    /**
     * Creates a new slider entity.
     *
     * @Route("/new", name="responsable_slider_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $slider = new Slider();
        $form   = $this->createForm('AppBundle\Form\SliderType', $slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();

            return $this->redirectToRoute('responsable_slider_show', array('id' => $slider->getId()));
        }

        return $this->render('@App/Responsable/slider/new.html.twig', array(
            'slider' => $slider,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a slider entity.
     *
     * @Route("/{id}", name="responsable_slider_show")
     * @Method("GET")
     */
    public function showAction(Slider $slider)
    {
        $deleteForm = $this->createDeleteForm($slider);

        return $this->render('@App/Responsable/slider/show.html.twig', array(
            'slider'      => $slider,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing slider entity.
     *
     * @Route("/{id}/edit", name="responsable_slider_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Slider $slider)
    {
        $deleteForm = $this->createDeleteForm($slider);
        $editForm   = $this->createForm('AppBundle\Form\SliderType', $slider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('responsable_slider_edit', array('id' => $slider->getId()));
        }

        return $this->render('@App/Responsable/slider/edit.html.twig', array(
            'slider'      => $slider,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a slider entity.
     *
     * @Route("/{id}", name="responsable_slider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Slider $slider)
    {
        $form = $this->createDeleteForm($slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($slider);
            $em->flush();
        }

        return $this->redirectToRoute('responsable_slider_index');
    }

    /**
     * Creates a form to delete a slider entity.
     *
     * @param Slider $slider The slider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Slider $slider)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('responsable_slider_delete', array('id' => $slider->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
