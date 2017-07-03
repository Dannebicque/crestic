<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Departements;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Departement controller.
 *
 * @Route("administration/departements")
 */
class DepartementsController extends Controller
{
    /**
     * Lists all departement entities.
     *
     * @Route("/", name="administration_departements_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departements = $em->getRepository('AppBundle:Departements')->findAll();

        return $this->render('@App/Administration/departements/index.html.twig', array(
            'departements' => $departements,
        ));
    }

    /**
     * Creates a new departement entity.
     *
     * @Route("/new", name="administration_departements_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $departement = new Departements();
        $form        = $this->createForm('AppBundle\Form\DepartementsType', $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($departement);
            $em->flush();

            return $this->redirectToRoute('administration_departements_show', array('id' => $departement->getId()));
        }

        return $this->render('@App/Administration/departements/new.html.twig', array(
            'departement' => $departement,
            'form'        => $form->createView(),
        ));
    }

    /**
     * Finds and displays a departement entity.
     *
     * @Route("/{id}", name="administration_departements_show")
     * @Method("GET")
     */
    public function showAction(Departements $departement)
    {
        $deleteForm = $this->createDeleteForm($departement);

        return $this->render('@App/Administration/departements/show.html.twig', array(
            'departement' => $departement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing departement entity.
     *
     * @Route("/{id}/edit", name="administration_departements_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Departements $departement)
    {
        $deleteForm = $this->createDeleteForm($departement);
        $editForm   = $this->createForm('AppBundle\Form\DepartementsType', $departement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_departements_edit', array('id' => $departement->getId()));
        }

        return $this->render('@App/Administration/departements/edit.html.twig', array(
            'departement' => $departement,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a departement entity.
     *
     * @Route("/{id}", name="administration_departements_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Departements $departement)
    {
        $form = $this->createDeleteForm($departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($departement);
            $em->flush();
        }

        return $this->redirectToRoute('administration_departements_index');
    }

    /**
     * Creates a form to delete a departement entity.
     *
     * @param Departements $departement The departement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Departements $departement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_departements_delete', array('id' => $departement->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
