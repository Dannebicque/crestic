<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Actualites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Actualite controller.
 *
 * @Route("administration/actualites")
 */
class ActualitesController extends Controller
{
    /**
     * Lists all actualite entities.
     *
     * @Route("/", name="administration_actualites_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('AppBundle:Actualites')->findAll();

        return $this->render('@App/Administration/actualites/index.html.twig', array(
            'actualites' => $actualites,
        ));
    }

    /**
     * Creates a new actualite entity.
     *
     * @Route("/new", name="administration_actualites_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $actualite = new Actualites();
        $form      = $this->createForm('AppBundle\Form\ActualitesType', $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $actualite->setMembreCrestic($this->getUser());

            $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

            $repository->translate($actualite, 'titre', 'en', $form->get('titreen')->getData())
                ->translate($actualite, 'message', 'en', $form->get('messageen')->getData())
                ->translate($actualite, 'keywords', 'en', $form->get('keywordsen')->getData());

            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('administration_actualites_show', array('id' => $actualite->getId()));
        }

        return $this->render('@App/Administration/actualites/new.html.twig', array(
            'actualite' => $actualite,
            'form'      => $form->createView(),
        ));
    }

    /**
     * Finds and displays a actualite entity.
     *
     * @Route("/{id}", name="administration_actualites_show")
     * @Method("GET")
     */
    public function showAction(Actualites $actualite)
    {
        $deleteForm = $this->createDeleteForm($actualite);

        return $this->render('@App/Administration/actualites/show.html.twig', array(
            'actualite'   => $actualite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing actualite entity.
     *
     * @Route("/{id}/edit", name="administration_actualites_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Actualites $actualite)
    {
        $editForm = $this->createForm('AppBundle\Form\ActualitesType', $actualite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_actualites_show', array('id' => $actualite->getId()));
        }

        return $this->render('@App/Administration/actualites/edit.html.twig', array(
            'actualite' => $actualite,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a actualite entity.
     *
     * @Route("/{id}", name="administration_actualites_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Actualites $actualite)
    {
        $form = $this->createDeleteForm($actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($actualite);
            $em->flush();
        }

        return $this->redirectToRoute('administration_actualites_index');
    }

    /**
     * Creates a form to delete a actualite entity.
     *
     * @param Actualites $actualite The actualite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Actualites $actualite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_actualites_delete', array('id' => $actualite->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
