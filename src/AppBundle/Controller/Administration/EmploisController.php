<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Emplois;
use AppBundle\Form\EmploisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Emplois controller.
 *
 * @Route("/administration/emplois")
 */
class EmploisController extends Controller
{
    /**
     * Lists all emplois entities.
     *
     * @Route("/", name="administration_emplois_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $emplois = $em->getRepository('AppBundle:Emplois')->findAll();

        return $this->render('@App/Administration/emplois/index.html.twig', array(
            'emplois' => $emplois,
        ));
    }

    /**
     * Creates a new emplois entity.
     *
     * @Route("/new", name="administration_emplois_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $emplois = new Emplois();
        $form    = $this->createForm(EmploisType::class, $emplois);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emplois);
            $em->flush();

            return $this->redirectToRoute('administration_emplois_show', array('id' => $emplois->getId()));
        }

        return $this->render('@App/Administration/emplois/new.html.twig', array(
            'emplois' => $emplois,
            'form'    => $form->createView(),
        ));
    }

    /**
     * Finds and displays a emplois entity.
     *
     * @Route("/{id}", name="administration_emplois_show")
     * @Method("GET")
     * @param Emplois $emplois
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(Emplois $emplois)
    {
        $deleteForm = $this->createDeleteForm($emplois);

        return $this->render('@App/Administration/emplois/show.html.twig', array(
            'emplois'     => $emplois,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing emplois entity.
     *
     * @Route("/{id}/edit", name="administration_emplois_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Emplois $emplois
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Emplois $emplois)
    {
        $editForm = $this->createForm(EmploisType::class, $emplois);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_emplois_edit', array('id' => $emplois->getId()));
        }

        return $this->render('@App/Administration/emplois/edit.html.twig', array(
            'emplois'   => $emplois,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a emplois entity.
     *
     * @Route("/{id}", name="administration_emplois_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Emplois $emplois
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, Emplois $emplois)
    {
        $form = $this->createDeleteForm($emplois);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($emplois);
            $em->flush();
        }

        return $this->redirectToRoute('administration_emplois_index');
    }

    /**
     * Creates a form to delete a emplois entity.
     *
     * @param Emplois $emplois The emplois entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Emplois $emplois)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_emplois_delete', array('id' => $emplois->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
