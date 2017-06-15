<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Pays;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pays controller.
 *
 * @Route("/administration/pays")
 */
class PaysController extends Controller
{
    /**
     * Lists all pay entities.
     *
     * @Route("/", name="administration_pays_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pays = $em->getRepository('AppBundle:Pays')->findAll();

        return $this->render('@App/Administration/pays/index.html.twig', array(
            'pays' => $pays,
        ));
    }

    /**
     * Creates a new pay entity.
     *
     * @Route("/new", name="administration_pays_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pay = new Pay();
        $form = $this->createForm('AppBundle\Form\PaysType', $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pay);
            $em->flush();

            return $this->redirectToRoute('administration_pays_show', array('id' => $pay->getId()));
        }

        return $this->render('@App/Administration/pays/new.html.twig', array(
            'pay' => $pay,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pay entity.
     *
     * @Route("/{id}", name="administration_pays_show")
     * @Method("GET")
     */
    public function showAction(Pays $pay)
    {
        $deleteForm = $this->createDeleteForm($pay);

        return $this->render('@App/Administration/pays/show.html.twig', array(
            'pay' => $pay,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pay entity.
     *
     * @Route("/{id}/edit", name="administration_pays_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pays $pay)
    {
        $editForm = $this->createForm('AppBundle\Form\PaysType', $pay);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_pays_edit', array('id' => $pay->getId()));
        }

        return $this->render('@App/Administration/pays/edit.html.twig', array(
            'pay' => $pay,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a pay entity.
     *
     * @Route("/{id}", name="administration_pays_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pays $pay)
    {
        $form = $this->createDeleteForm($pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pay);
            $em->flush();
        }

        return $this->redirectToRoute('administration_pays_index');
    }

    /**
     * Creates a form to delete a pay entity.
     *
     * @param Pays $pay The pay entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pays $pay)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_pays_delete', array('id' => $pay->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
