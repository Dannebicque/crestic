<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Conferences;
use AppBundle\Form\ConferencesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Conference controller.
 *
 * @Route("administration/conferences")
 */
class ConferencesController extends Controller
{
    /**
     * Lists all conference entities.
     *
     * @Route("/", name="administration_conferences_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conferences = $em->getRepository('AppBundle:Conferences')->findAll();

        return $this->render('@App/Administration/conferences/index.html.twig', array(
            'conferences' => $conferences,
        ));
    }

    /**
     * Creates a new conference entity.
     *
     * @Route("/new", name="administration_conferences_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $conference = new Conferences();
        $form       = $this->createForm(ConferencesType::class, $conference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conference);
            $em->flush();

            return $this->redirectToRoute('administration_conferences_show', array('id' => $conference->getId()));
        }

        return $this->render('@App/Administration/conferences/new.html.twig', array(
            'conference' => $conference,
            'form'       => $form->createView(),
        ));
    }

    /**
     * Finds and displays a conference entity.
     *
     * @Route("/{id}", name="administration_conferences_show")
     * @Method("GET")
     * @param Conferences $conference
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(Conferences $conference)
    {
        $deleteForm = $this->createDeleteForm($conference);

        return $this->render('@App/Administration/conferences/show.html.twig', array(
            'conference'  => $conference,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing conference entity.
     *
     * @Route("/{id}/edit", name="administration_conferences_edit")
     * @Method({"GET", "POST"})
     * @param Request     $request
     * @param Conferences $conference
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Conferences $conference)
    {
        $editForm = $this->createForm(ConferencesType::class, $conference);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_conferences_edit', array('id' => $conference->getId()));
        }

        return $this->render('@App/Administration/conferences/edit.html.twig', array(
            'conference' => $conference,
            'edit_form'  => $editForm->createView(),
        ));
    }

    /**
     * Deletes a conference entity.
     *
     * @Route("/{id}", name="administration_conferences_delete")
     * @Method("DELETE")
     * @param Request     $request
     * @param Conferences $conference
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, Conferences $conference)
    {
        $form = $this->createDeleteForm($conference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($conference);
            $em->flush();
        }

        return $this->redirectToRoute('administration_conferences_index');
    }

    /**
     * Creates a form to delete a conference entity.
     *
     * @param Conferences $conference The conference entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Conferences $conference)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_conferences_delete', array('id' => $conference->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
