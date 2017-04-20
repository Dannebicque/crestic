<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Plateformes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Plateforme controller.
 *
 * @Route("/administration/plateformes")
 */
class PlateformesController extends Controller
{
    /**
     * Lists all plateforme entities.
     *
     * @Route("/", name="administration_plateformes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plateformes = $em->getRepository('AppBundle:Plateformes')->findAll();

        return $this->render('@App/Administration/plateformes/index.html.twig', array(
            'plateformes' => $plateformes,
        ));
    }

    /**
     * Creates a new plateforme entity.
     *
     * @Route("/new", name="administration_plateformes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plateforme = new Plateformes();
        $form = $this->createForm('AppBundle\Form\PlateformesType', $plateforme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plateforme);
            $em->flush();

            return $this->redirectToRoute('administration_plateformes_show', array('id' => $plateforme->getId()));
        }

        return $this->render('@App/Administration/plateformes/new.html.twig', array(
            'plateforme' => $plateforme,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plateforme entity.
     *
     * @Route("/{id}", name="administration_plateformes_show")
     * @Method("GET")
     */
    public function showAction(Plateformes $plateforme)
    {
        $deleteForm = $this->createDeleteForm($plateforme);

        return $this->render('@App/Administration/plateformes/show.html.twig', array(
            'plateforme' => $plateforme,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plateforme entity.
     *
     * @Route("/{id}/edit", name="administration_plateformes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Plateformes $plateforme)
    {
        $editForm = $this->createForm('AppBundle\Form\PlateformesType', $plateforme);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_plateformes_edit', array('id' => $plateforme->getId()));
        }

        return $this->render('@App/Administration/plateformes/edit.html.twig', array(
            'plateforme' => $plateforme,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a plateforme entity.
     *
     * @Route("/{id}", name="administration_plateformes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Plateformes $plateforme)
    {
        $form = $this->createDeleteForm($plateforme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plateforme);
            $em->flush();
        }

        return $this->redirectToRoute('administration_plateformes_index');
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
            ->setAction($this->generateUrl('administration_plateformes_delete', array('id' => $plateforme->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
