<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Slider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Slider controller.
 *
 * @Route("administration/slider")
 */
class SliderController extends Controller
{
    /**
     * Lists all slider entities.
     *
     * @Route("/", name="administration_slider_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sliders = $em->getRepository('AppBundle:Slider')->findAll();

        return $this->render('@App/Administration/slider/index.html.twig', array(
            'sliders' => $sliders,
        ));
    }

    /**
     * Creates a new slider entity.
     *
     * @Route("/new", name="administration_slider_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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

            return $this->redirectToRoute('administration_slider_show', array('id' => $slider->getId()));
        }

        return $this->render('@App/Administration/slider/new.html.twig', array(
            'slider' => $slider,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a slider entity.
     *
     * @Route("/{id}", name="administration_slider_show")
     * @Method("GET")
     * @param Slider $slider
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(Slider $slider)
    {
        $deleteForm = $this->createDeleteForm($slider);

        return $this->render('@App/Administration/slider/show.html.twig', array(
            'slider'      => $slider,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing slider entity.
     *
     * @Route("/{id}/edit", name="administration_slider_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Slider  $slider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Slider $slider)
    {
        $deleteForm = $this->createDeleteForm($slider);
        $editForm   = $this->createForm('AppBundle\Form\SliderType', $slider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_slider_edit', array('id' => $slider->getId()));
        }

        return $this->render('@App/Administration/slider/edit.html.twig', array(
            'slider'      => $slider,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a slider entity.
     *
     * @Route("/{id}", name="administration_slider_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Slider  $slider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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

        return $this->redirectToRoute('administration_slider_index');
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
            ->setAction($this->generateUrl('administration_slider_delete', array('id' => $slider->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
