<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\MembresExterieurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Membresexterieur controller.
 *
 * @Route("/administration/membresexterieurs")
 */
class MembresExterieursController extends Controller
{
    /**
     * Lists all membresExterieur entities.
     *
     * @Route("/", name="administration_membresexterieurs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membresExterieurs = $em->getRepository('AppBundle:MembresExterieurs')->findAll();

        return $this->render('@App/Administration/membresexterieurs/index.html.twig', array(
            'membresExterieurs' => $membresExterieurs,
        ));
    }

    /**
     * Creates a new membresExterieur entity.
     *
     * @Route("/new", name="administration_membresexterieurs_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $membresExterieur = new MembresExterieurs();
        $form = $this->createForm('AppBundle\Form\MembresExterieursType', $membresExterieur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($membresExterieur);
            $em->flush();

            return $this->redirectToRoute('membresexterieurs_show', array('id' => $membresExterieur->getId()));
        }

        return $this->render('@App/Administration/membresexterieurs/new.html.twig', array(
            'membresExterieur' => $membresExterieur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a membresExterieur entity.
     *
     * @Route("/{id}", name="administration_membresexterieurs_show")
     * @Method("GET")
     * @param MembresExterieurs $membresExterieur
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(MembresExterieurs $membresExterieur)
    {
        $deleteForm = $this->createDeleteForm($membresExterieur);

        return $this->render('@App/Administration/membresexterieurs/show.html.twig', array(
            'membresExterieur' => $membresExterieur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing membresExterieur entity.
     *
     * @Route("/{id}/edit", name="administration_membresexterieurs_edit")
     * @Method({"GET", "POST"})
     * @param Request           $request
     * @param MembresExterieurs $membresExterieur
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, MembresExterieurs $membresExterieur)
    {
        $deleteForm = $this->createDeleteForm($membresExterieur);
        $editForm = $this->createForm('AppBundle\Form\MembresExterieursType', $membresExterieur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_membresexterieurs_edit', array('id' => $membresExterieur->getId()));
        }

        return $this->render('@App/Administration/membresexterieurs/edit.html.twig', array(
            'membresExterieur' => $membresExterieur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a membresExterieur entity.
     *
     * @Route("/{id}", name="administration_membresexterieurs_delete")
     * @Method("DELETE")
     * @param Request           $request
     * @param MembresExterieurs $membresExterieur
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, MembresExterieurs $membresExterieur)
    {
        $form = $this->createDeleteForm($membresExterieur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($membresExterieur);
            $em->flush();
        }

        return $this->redirectToRoute('administration_membresexterieurs_index');
    }

    /**
     * Creates a form to delete a membresExterieur entity.
     *
     * @param MembresExterieurs $membresExterieur The membresExterieur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MembresExterieurs $membresExterieur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_membresexterieurs_delete', array('id' => $membresExterieur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
