<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Equipes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Equipe controller.
 *
 * @Route("administration/equipes")
 */
class EquipesController extends Controller
{
    /**
     * Lists all equipe entities.
     *
     * @Route("/", name="administration_equipes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipes = $em->getRepository('AppBundle:Equipes')->findAll();

        return $this->render('@App/Administration/equipes/index.html.twig', array(
            'equipes' => $equipes,
        ));
    }

    /**
     * Creates a new equipe entity.
     *
     * @Route("/new", name="administration_equipes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $equipe = new Equipes();
        $form = $this->createForm('AppBundle\Form\EquipesType', $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush();

            return $this->redirectToRoute('administration_equipes_show', array('id' => $equipe->getId()));
        }

        return $this->render('@App/Administration/equipes/new.html.twig', array(
            'equipe' => $equipe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipe entity.
     *
     * @Route("/{id}", name="administration_equipes_show")
     * @Method("GET")
     */
    public function showAction(Equipes $equipe)
    {
        $deleteForm = $this->createDeleteForm($equipe);

        return $this->render('@App/Administration/equipes/show.html.twig', array(
            'equipe' => $equipe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipe entity.
     *
     * @Route("/{id}/edit", name="administration_equipes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Equipes $equipe)
    {
        $editForm = $this->createForm('AppBundle\Form\EquipesType', $equipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_equipes_edit', array('id' => $equipe->getId()));
        }

        return $this->render('@App/Administration/equipes/edit.html.twig', array(
            'equipe' => $equipe,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a equipe entity.
     *
     * @Route("/{id}", name="administration_equipes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Equipes $equipe)
    {
        $form = $this->createDeleteForm($equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipe);
            $em->flush();
        }

        return $this->redirectToRoute('administration_equipes_index');
    }

    /**
     * Creates a form to delete a equipe entity.
     *
     * @param Equipes $equipe The equipe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipes $equipe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_equipes_delete', array('id' => $equipe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
