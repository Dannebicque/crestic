<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Revues;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Revue controller.
 *
 * @Route("administration/revues")
 */
class RevuesController extends Controller
{
    /**
     * Lists all revue entities.
     *
     * @Route("/", name="administration_revues_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $revues = $em->getRepository('AppBundle:Revues')->findAll();

        return $this->render('@App/Administration/revues/index.html.twig', array(
            'revues' => $revues,
        ));
    }

    /**
     * Creates a new revue entity.
     *
     * @Route("/new", name="administration_revues_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $revue = new Revues();
        $form  = $this->createForm('AppBundle\Form\RevuesType', $revue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($revue);
            $em->flush();

            return $this->redirectToRoute('administration_revues_show', array('id' => $revue->getId()));
        }

        return $this->render('@App/Administration/revues/new.html.twig', array(
            'revue' => $revue,
            'form'  => $form->createView(),
        ));
    }

    /**
     * Finds and displays a revue entity.
     *
     * @Route("/{id}", name="administration_revues_show")
     * @Method("GET")
     * @param Revues $revue
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(Revues $revue)
    {
        $deleteForm = $this->createDeleteForm($revue);

        return $this->render('@App/Administration/revues/show.html.twig', array(
            'revue'       => $revue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing revue entity.
     *
     * @Route("/{id}/edit", name="administration_revues_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Revues  $revue
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Revues $revue)
    {
        $editForm = $this->createForm('AppBundle\Form\RevuesType', $revue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_revues_edit', array('id' => $revue->getId()));
        }

        return $this->render('@App/Administration/revues/edit.html.twig', array(
            'revue'     => $revue,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a revue entity.
     *
     * @Route("/{id}", name="administration_revues_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Revues  $revue
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, Revues $revue)
    {
        $form = $this->createDeleteForm($revue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($revue);
            $em->flush();
        }

        return $this->redirectToRoute('administration_revues_index');
    }

    /**
     * Creates a form to delete a revue entity.
     *
     * @param Revues $revue The revue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Revues $revue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_revues_delete', array('id' => $revue->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
