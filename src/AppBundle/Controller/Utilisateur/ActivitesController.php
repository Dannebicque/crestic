<?php

namespace AppBundle\Controller\Utilisateur;

use AppBundle\Entity\Activites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Activite controller.
 *
 * @Route("/espace-utilisateur/activites")
 */
class ActivitesController extends Controller
{
    /**
     * Lists all activite entities.
     *
     * @Route("/", name="utilisateur_activites_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $activites = $em->getRepository('AppBundle:Activites')->findActivitesMembre($this->getUser()->getId());

        return $this->render('@App/Utilisateur/activites/index.html.twig', array(
            'activites' => $activites,
        ));
    }

    /**
     * Creates a new activite entity.
     *
     * @Route("/new", name="utilisateur_activites_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $activite = new Activites($this->getUser());
        $form     = $this->createForm('AppBundle\Form\ActivitesType', $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activite);
            $em->flush();

            return $this->redirectToRoute('utilisateur_activites_show', array('id' => $activite->getId()));
        }

        return $this->render('@App/Utilisateur/activites/new.html.twig', array(
            'activite' => $activite,
            'form'     => $form->createView(),
        ));
    }

    /**
     * Finds and displays a activite entity.
     *
     * @Route("/{id}", name="utilisateur_activites_show")
     * @Method("GET")
     * @param Activites $activite
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(Activites $activite)
    {
        $deleteForm = $this->createDeleteForm($activite);

        return $this->render('@App/Utilisateur/activites/show.html.twig', array(
            'activite'    => $activite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing activite entity.
     *
     * @Route("/{id}/edit", name="utilisateur_activites_edit")
     * @Method({"GET", "POST"})
     * @param Request   $request
     * @param Activites $activite
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Activites $activite)
    {
        $editForm = $this->createForm('AppBundle\Form\ActivitesType', $activite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('utilisateur_activites_show', array('id' => $activite->getId()));
        }

        return $this->render('@App/Utilisateur/activites/edit.html.twig', array(
            'activite'  => $activite,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a activite entity.
     *
     * @Route("/{id}", name="utilisateur_activites_delete")
     * @Method("DELETE")
     * @param Request   $request
     * @param Activites $activite
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, Activites $activite)
    {
        $form = $this->createDeleteForm($activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activite);
            $em->flush();
        }

        return $this->redirectToRoute('utilisateur_activites_index');
    }

    /**
     * Creates a form to delete a activite entity.
     *
     * @param Activites $activite The activite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Activites $activite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisateur_activites_delete', array('id' => $activite->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
