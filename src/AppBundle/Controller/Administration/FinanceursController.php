<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Financeurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Financeurs controller.
 *
 * @Route("administration/financeurs")
 */
class FinanceursController extends Controller
{
    /**
     * Lists all financeur entities.
     *
     * @Route("/", name="administration_financeurs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $financeurs = $em->getRepository('AppBundle:Financeurs')->findAll();

        return $this->render('@App/Administration/financeurs/index.html.twig', array(
            'financeurs' => $financeurs,
        ));
    }

    /**
     * Creates a new financeur entity.
     *
     * @Route("/new", name="administration_financeurs_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $financeur = new Financeurs();
        $form       = $this->createForm('AppBundle\Form\FinanceursType', $financeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($financeur);
            $em->flush();

            return $this->redirectToRoute('administration_financeurs_show', array('id' => $financeur->getId()));
        }

        return $this->render('@App/Administration/financeurs/new.html.twig', array(
            'financeur' => $financeur,
            'form'       => $form->createView(),
        ));
    }

    /**
     * Finds and displays a financeurs entity.
     *
     * @Route("/{id}", name="administration_financeurs_show")
     * @Method("GET")
     * @param Financeurs $financeur
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(Financeurs $financeur)
    {
        $deleteForm = $this->createDeleteForm($financeur);

        return $this->render('@App/Administration/financeurs/show.html.twig', array(
            'financeur'  => $financeur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing financeurs entity.
     *
     * @Route("/{id}/edit", name="administration_financeurs_edit")
     * @Method({"GET", "POST"})
     * @param Request    $request
     * @param Financeurs $financeur
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Financeurs $financeur)
    {
        $deleteForm = $this->createDeleteForm($financeur);
        $editForm   = $this->createForm('AppBundle\Form\FinanceursType', $financeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_financeurs_edit', array('id' => $financeur->getId()));
        }

        return $this->render('@App/Administration/financeurs/edit.html.twig', array(
            'financeur'  => $financeur,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a financeurs entity.
     *
     * @Route("/{id}", name="administration_financeurs_delete")
     * @Method("DELETE")
     * @param Request    $request
     * @param Financeurs $financeur
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, Financeurs $financeur)
    {
        $form = $this->createDeleteForm($financeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($financeur);
            $em->flush();
        }

        return $this->redirectToRoute('administration_financeurs_index');
    }

    /**
     * Creates a form to delete a partenaire entity.
     *
     * @param Financeurs $financeur The financeurs entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Financeurs $financeur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_financeurs_delete', array('id' => $financeur->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
