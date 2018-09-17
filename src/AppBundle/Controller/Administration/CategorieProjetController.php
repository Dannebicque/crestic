<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\CategorieProjet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Categorieprojet controller.
 *
 * @Route("administration/categorie-projet")
 */
class CategorieProjetController extends Controller
{
    /**
     * Lists all categorieProjet entities.
     *
     * @Route("/", name="administration_categorieprojet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieProjets = $em->getRepository('AppBundle:CategorieProjet')->findAll();

        return $this->render('@App/Administration/categorieprojet/index.html.twig', array(
            'categorieProjets' => $categorieProjets,
        ));
    }

    /**
     * Creates a new categorieProjet entity.
     *
     * @Route("/new", name="administration_categorieprojet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categorieProjet = new Categorieprojet();
        $form = $this->createForm('AppBundle\Form\CategorieProjetType', $categorieProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieProjet);
            $em->flush();

            return $this->redirectToRoute('administration_categorieprojet_show', array('id' => $categorieProjet->getId()));
        }

        return $this->render('@App/Administration/categorieprojet/new.html.twig', array(
            'categorieProjet' => $categorieProjet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorieProjet entity.
     *
     * @Route("/{id}", name="administration_categorieprojet_show")
     * @Method("GET")
     */
    public function showAction(CategorieProjet $categorieProjet)
    {
        $deleteForm = $this->createDeleteForm($categorieProjet);

        return $this->render('@App/Administration/categorieprojet/show.html.twig', array(
            'categorieProjet' => $categorieProjet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorieProjet entity.
     *
     * @Route("/{id}/edit", name="administration_categorieprojet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategorieProjet $categorieProjet)
    {
        $deleteForm = $this->createDeleteForm($categorieProjet);
        $editForm = $this->createForm('AppBundle\Form\CategorieProjetType', $categorieProjet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_categorieprojet_edit', array('id' => $categorieProjet->getId()));
        }

        return $this->render('@App/Administration/categorieprojet/edit.html.twig', array(
            'categorieProjet' => $categorieProjet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorieProjet entity.
     *
     * @Route("/{id}", name="administration_categorieprojet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CategorieProjet $categorieProjet)
    {
        $form = $this->createDeleteForm($categorieProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieProjet);
            $em->flush();
        }

        return $this->redirectToRoute('administration_categorieprojet_index');
    }

    /**
     * Creates a form to delete a categorieProjet entity.
     *
     * @param CategorieProjet $categorieProjet The categorieProjet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategorieProjet $categorieProjet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_categorieprojet_delete', array('id' => $categorieProjet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
