<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\DemandeOM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Demandeom controller.
 *
 * @Route("/administration/demande-om")
 */
class DemandeOMController extends Controller
{
    /**
     * Lists all demandeOM entities.
     *
     * @Route("/", name="administration_demande-om_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $demandeOMs = $em->getRepository('AppBundle:DemandeOM')->findAll();

        return $this->render('@App/Administration/demandeom/index.html.twig', array(
            'demandeOMs' => $demandeOMs,
        ));
    }

    /**
     * Creates a new demandeOM entity.
     *
     * @Route("/new", name="administration_demande-om_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $demandeOM = new DemandeOM();
        $form = $this->createForm('AppBundle\Form\DemandeOMType', $demandeOM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demandeOM);
            $em->flush();

            return $this->redirectToRoute('administration_demande-om_show', array('id' => $demandeOM->getId()));
        }

        return $this->render('@App/Administration/demandeom/new.html.twig', array(
            'demandeOM' => $demandeOM,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demandeOM entity.
     *
     * @Route("/{id}", name="administration_demande-om_show")
     * @Method("GET")
     */
    public function showAction(DemandeOM $demandeOM)
    {
        $deleteForm = $this->createDeleteForm($demandeOM);

        return $this->render('@App/Administration/demandeom/show.html.twig', array(
            'demandeOM' => $demandeOM,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing demandeOM entity.
     *
     * @Route("/{id}/edit", name="administration_demande-om_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DemandeOM $demandeOM)
    {
        $editForm = $this->createForm('AppBundle\Form\DemandeOMType', $demandeOM);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_demande-om_edit', array('id' => $demandeOM->getId()));
        }

        return $this->render('@App/Administration/demandeom/edit.html.twig', array(
            'demandeOM' => $demandeOM,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a demandeOM entity.
     *
     * @Route("/{id}", name="administration_demande-om_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DemandeOM $demandeOM)
    {
        $form = $this->createDeleteForm($demandeOM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demandeOM);
            $em->flush();
        }

        return $this->redirectToRoute('administration_demande-om_index');
    }

    /**
     * Creates a form to delete a demandeOM entity.
     *
     * @param DemandeOM $demandeOM The demandeOM entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DemandeOM $demandeOM)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_demande-om_delete', array('id' => $demandeOM->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
