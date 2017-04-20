<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Projets;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Projet controller.
 *
 * @Route("/administration/projets")
 */
class ProjetsController extends Controller
{
    /**
     * Lists all projet entities.
     *
     * @Route("/", name="administration_projets_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('AppBundle:Projets')->findAll();

        return $this->render('@App/Administration/projets/index.html.twig', array(
            'projets' => $projets,
        ));
    }

    /**
     * Creates a new projet entity.
     *
     * @Route("/new", name="administration_projets_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $projet = new Projets();
        $form = $this->createForm('AppBundle\Form\ProjetsType', $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projet);
            $em->flush();

            return $this->redirectToRoute('administration_projets_show', array('id' => $projet->getId()));
        }

        return $this->render('@App/Administration/projets/new.html.twig', array(
            'projet' => $projet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projet entity.
     *
     * @Route("/{id}", name="administration_projets_show")
     * @Method("GET")
     */
    public function showAction(Projets $projet)
    {
        $deleteForm = $this->createDeleteForm($projet);

        return $this->render('@App/Administration/projets/show.html.twig', array(
            'projet' => $projet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projet entity.
     *
     * @Route("/{id}/edit", name="administration_projets_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Projets $projet)
    {
        $editForm = $this->createForm('AppBundle\Form\ProjetsType', $projet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_projets_edit', array('id' => $projet->getId()));
        }

        return $this->render('@App/Administration/projets/edit.html.twig', array(
            'projet' => $projet,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a projet entity.
     *
     * @Route("/{id}", name="administration_projets_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Projets $projet)
    {
        $form = $this->createDeleteForm($projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projet);
            $em->flush();
        }

        return $this->redirectToRoute('administration_projets_index');
    }

    /**
     * Creates a form to delete a projet entity.
     *
     * @param Projets $projet The projet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Projets $projet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_projets_delete', array('id' => $projet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
