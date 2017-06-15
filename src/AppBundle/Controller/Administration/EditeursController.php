<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Editeurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Editeur controller.
 *
 * @Route("/administration/editeurs")
 */
class EditeursController extends Controller
{
    /**
     * Lists all editeur entities.
     *
     * @Route("/", name="administration_editeur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $editeurs = $em->getRepository('AppBundle:Editeurs')->findAll();

        return $this->render('@App/Administration/editeurs/index.html.twig', array(
            'editeurs' => $editeurs,
        ));
    }

    /**
     * Creates a new editeur entity.
     *
     * @Route("/new", name="administration_editeur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $editeur = new Editeurs();
        $form = $this->createForm('AppBundle\Form\EditeursType', $editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($editeur);
            $em->flush();

            return $this->redirectToRoute('administration_editeur_show', array('id' => $editeur->getId()));
        }

        return $this->render('@App/Administration/editeurs/new.html.twig', array(
            'editeur' => $editeur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a editeur entity.
     *
     * @Route("/{id}", name="administration_editeur_show")
     * @Method("GET")
     */
    public function showAction(Editeurs $editeur)
    {
        $deleteForm = $this->createDeleteForm($editeur);

        return $this->render('@App/Administration/editeurs/show.html.twig', array(
            'editeur' => $editeur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing editeur entity.
     *
     * @Route("/{id}/edit", name="administration_editeur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Editeurs $editeur)
    {
        $editForm = $this->createForm('AppBundle\Form\EditeursType', $editeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_editeur_edit', array('id' => $editeur->getId()));
        }

        return $this->render('@App/Administration/editeurs/edit.html.twig', array(
            'editeur' => $editeur,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a editeur entity.
     *
     * @Route("/{id}", name="administration_editeur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Editeurs $editeur)
    {
        $form = $this->createDeleteForm($editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($editeur);
            $em->flush();
        }

        return $this->redirectToRoute('administration_editeur_index');
    }

    /**
     * Creates a form to delete a editeur entity.
     *
     * @param Editeurs $editeur The editeur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Editeurs $editeur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_editeur_delete', array('id' => $editeur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
