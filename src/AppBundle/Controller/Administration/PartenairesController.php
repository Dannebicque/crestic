<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Partenaires;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Partenaire controller.
 *
 * @Route("administration/partenaires")
 */
class PartenairesController extends Controller
{
    /**
     * Lists all partenaire entities.
     *
     * @Route("/", name="administration_partenaires_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partenaires = $em->getRepository('AppBundle:Partenaires')->findAll();

        return $this->render('@App/Administration/partenaires/index.html.twig', array(
            'partenaires' => $partenaires,
        ));
    }

    /**
     * Creates a new partenaire entity.
     *
     * @Route("/new", name="administration_partenaires_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $partenaire = new Partenaires();
        $form       = $this->createForm('AppBundle\Form\PartenairesType', $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partenaire);
            $em->flush();

            return $this->redirectToRoute('administration_partenaires_show', array('id' => $partenaire->getId()));
        }

        return $this->render('@App/Administration/partenaires/new.html.twig', array(
            'partenaire' => $partenaire,
            'form'       => $form->createView(),
        ));
    }

    /**
     * Finds and displays a partenaire entity.
     *
     * @Route("/{id}", name="administration_partenaires_show")
     * @Method("GET")
     */
    public function showAction(Partenaires $partenaire)
    {
        $deleteForm = $this->createDeleteForm($partenaire);

        return $this->render('@App/Administration/partenaires/show.html.twig', array(
            'partenaire'  => $partenaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing partenaire entity.
     *
     * @Route("/{id}/edit", name="administration_partenaires_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Partenaires $partenaire)
    {
        $deleteForm = $this->createDeleteForm($partenaire);
        $editForm   = $this->createForm('AppBundle\Form\PartenairesType', $partenaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_partenaires_edit', array('id' => $partenaire->getId()));
        }

        return $this->render('@App/Administration/partenaires/edit.html.twig', array(
            'partenaire'  => $partenaire,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a partenaire entity.
     *
     * @Route("/{id}", name="administration_partenaires_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Partenaires $partenaire)
    {
        $form = $this->createDeleteForm($partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partenaire);
            $em->flush();
        }

        return $this->redirectToRoute('administration_partenaires_index');
    }

    /**
     * Creates a form to delete a partenaire entity.
     *
     * @param Partenaires $partenaire The partenaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Partenaires $partenaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_partenaires_delete', array('id' => $partenaire->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
