<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Cms;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Cm controller.
 *
 * @Route("/administration/cms")
 */
class CmsController extends Controller
{
    /**
     * Lists all cm entities.
     *
     * @Route("/", name="administration_cms_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cms = $em->getRepository('AppBundle:Cms')->findAll();

        return $this->render('AppBundle:Administration/cms:index.html.twig', array(
            'cms' => $cms,
        ));
    }

    /**
     * Creates a new cm entity.
     *
     * @Route("/new", name="administration_cms_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cm   = new Cms();
        $form = $this->createForm('AppBundle\Form\CmsType', $cm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cm);
            $em->flush();

            return $this->redirectToRoute('administration_cms_show', array('id' => $cm->getId()));
        }

        return $this->render('AppBundle:Administration/cms:new.html.twig', array(
            'cm'   => $cm,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cm entity.
     *
     * @Route("/{id}", name="administration_cms_show")
     * @Method("GET")
     */
    public function showAction(Cms $cm)
    {
        $deleteForm = $this->createDeleteForm($cm);

        return $this->render('@App/Administration/cms/show.html.twig', array(
            'cm'          => $cm,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cm entity.
     *
     * @Route("/{id}/edit", name="administration_cms_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cms $cm)
    {
        $editForm = $this->createForm('AppBundle\Form\CmsType', $cm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_cms_edit', array('id' => $cm->getId()));
        }

        return $this->render('AppBundle:Administration/cms:edit.html.twig', array(
            'cm'        => $cm,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a cm entity.
     *
     * @Route("/{id}", name="administration_cms_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cms $cm)
    {
        $form = $this->createDeleteForm($cm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cm);
            $em->flush();
        }

        return $this->redirectToRoute('administration_cms_index');
    }

    /**
     * Creates a form to delete a cm entity.
     *
     * @param Cms $cm The cm entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cms $cm)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_cms_delete', array('id' => $cm->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
