<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\MembresCrestic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Membrescrestic controller.
 *
 * @Route("/administration/membres")
 */
class MembresCresticController extends Controller
{
    /**
     * Lists all membresCrestic entities.
     *
     * @Route("/", name="administration_membres_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membresCrestics = $em->getRepository('AppBundle:MembresCrestic')->findAll();

        return $this->render('@App/Administration/membrescrestic/index.html.twig', array(
            'membresCrestics' => $membresCrestics,
        ));
    }

    /**
     * Creates a new membresCrestic entity.
     *
     * @Route("/new", name="administration_membres_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $membresCrestic = new Membrescrestic();
        $form = $this->createForm('AppBundle\Form\MembresCresticType', $membresCrestic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($membresCrestic);
            $em->flush();

            return $this->redirectToRoute('administration_membres_show', array('id' => $membresCrestic->getId()));
        }

        return $this->render('@App/Administration/membrescrestic/new.html.twig', array(
            'membresCrestic' => $membresCrestic,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a membresCrestic entity.
     *
     * @Route("/{id}", name="administration_membres_show")
     * @Method("GET")
     */
    public function showAction(MembresCrestic $membresCrestic)
    {
        $deleteForm = $this->createDeleteForm($membresCrestic);

        return $this->render('@App/Administration/membrescrestic/show.html.twig', array(
            'membresCrestic' => $membresCrestic,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing membresCrestic entity.
     *
     * @Route("/{id}/edit", name="administration_membres_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MembresCrestic $membresCrestic)
    {
        $deleteForm = $this->createDeleteForm($membresCrestic);
        $editForm = $this->createForm('AppBundle\Form\MembresCresticType', $membresCrestic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_membres_edit', array('id' => $membresCrestic->getId()));
        }

        return $this->render('@App/Administration/membrescrestic/edit.html.twig', array(
            'membresCrestic' => $membresCrestic,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a membresCrestic entity.
     *
     * @Route("/{id}", name="administration_membres_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MembresCrestic $membresCrestic)
    {
        $form = $this->createDeleteForm($membresCrestic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($membresCrestic);
            $em->flush();
        }

        return $this->redirectToRoute('administration_membres_index');
    }

    /**
     * Creates a form to delete a membresCrestic entity.
     *
     * @param MembresCrestic $membresCrestic The membresCrestic entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MembresCrestic $membresCrestic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_membres_delete', array('id' => $membresCrestic->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
