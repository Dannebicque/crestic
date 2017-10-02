<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Organigramme;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Organigramme controller.
 *
 * @Route("/administration/organigramme")
 */
class OrganigrammeController extends Controller
{
    /**
     * Lists all organigramme entities.
     *
     * @Route("/", name="administration_organigramme_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $organigrammes = $em->getRepository('AppBundle:Organigramme')->findAll();

        return $this->render('@App/Administration/organigramme/index.html.twig', array(
            'organigrammes' => $organigrammes,
        ));
    }

    /**
     * Creates a new organigramme entity.
     *
     * @Route("/new", name="administration_organigramme_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $organigramme = new Organigramme();
        $form = $this->createForm('AppBundle\Form\OrganigrammeType', $organigramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organigramme);
            $em->flush();

            return $this->redirectToRoute('administration_actualites_index', array('id' => $organigramme->getId()));
        }

        return $this->render('@App/Administration/organigramme/new.html.twig', array(
            'organigramme' => $organigramme,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing organigramme entity.
     *
     * @Route("/{id}/edit", name="administration_organigramme_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Organigramme $organigramme)
    {
        $deleteForm = $this->createDeleteForm($organigramme);
        $editForm = $this->createForm('AppBundle\Form\OrganigrammeType', $organigramme);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_organigramme_edit', array('id' => $organigramme->getId()));
        }

        return $this->render('@App/Administration/organigramme/edit.html.twig', array(
            'organigramme' => $organigramme,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a organigramme entity.
     *
     * @Route("/{id}", name="administration_organigramme_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Organigramme $organigramme)
    {
        $form = $this->createDeleteForm($organigramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($organigramme);
            $em->flush();
        }

        return $this->redirectToRoute('administration_organigramme_index');
    }

    /**
     * Creates a form to delete a organigramme entity.
     *
     * @param Organigramme $organigramme The organigramme entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Organigramme $organigramme)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_organigramme_delete', array('id' => $organigramme->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
