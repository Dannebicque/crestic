<?php

namespace AppBundle\Controller\Utilisateur;

use AppBundle\Entity\DemandeOM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Demandeom controller.
 *
 * @Route("/espace-utilisateur/demande-om")
 */
class DemandeOMController extends Controller
{
    /**
     * Lists all demandeOM entities.
     *
     * @Route("/", name="utilisateur_demande-om_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $demandeOMs = $em->getRepository('AppBundle:DemandeOM')->findOmsMembre($this->getUser()->getId());

        return $this->render('@App/Utilisateur/demandeom/index.html.twig', array(
            'demandeOMs' => $demandeOMs,
        ));
    }

    /**
     * Creates a new demandeOM entity.
     *
     * @Route("/new", name="utilisateur_demande-om_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $pays      = $this->getDoctrine()->getRepository('AppBundle:Pays')->findOneBy(array('nomFR' => 'France'));
        $demandeOM = new DemandeOM();
        $demandeOM->setMembreCrestic($this->getUser());
        $demandeOM->setPays($pays);
        $form = $this->createForm('AppBundle\Form\DemandeOMUtilisateurType', $demandeOM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demandeOM);
            $em->flush();

            return $this->redirectToRoute('utilisateur_demande-om_show', array('id' => $demandeOM->getId()));
        }

        return $this->render('@App/Utilisateur/demandeom/new.html.twig', array(
            'demandeOM' => $demandeOM,
            'form'      => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demandeOM entity.
     *
     * @Route("/{id}", name="utilisateur_demande-om_show")
     * @Method("GET")
     * @param DemandeOM $demandeOM
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(DemandeOM $demandeOM)
    {
        $deleteForm = $this->createDeleteForm($demandeOM);

        return $this->render('@App/Utilisateur/demandeom/show.html.twig', array(
            'demandeOM'   => $demandeOM,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing demandeOM entity.
     *
     * @Route("/{id}/edit", name="utilisateur_demande-om_edit")
     * @Method({"GET", "POST"})
     * @param Request   $request
     * @param DemandeOM $demandeOM
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, DemandeOM $demandeOM)
    {
        $editForm = $this->createForm('AppBundle\Form\DemandeOMUtilisateurType', $demandeOM);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('utilisateur_demande-om_index', array('id' => $demandeOM->getId()));
        }

        return $this->render('@App/Utilisateur/demandeom/edit.html.twig', array(
            'demandeOM' => $demandeOM,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a demandeOM entity.
     *
     * @Route("/{id}", name="utilisateur_demande-om_delete")
     * @Method("DELETE")
     * @param Request   $request
     * @param DemandeOM $demandeOM
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, DemandeOM $demandeOM)
    {
        $form = $this->createDeleteForm($demandeOM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demandeOM);
            $em->flush();
        }

        return $this->redirectToRoute('utilisateur_demande-om_index');
    }

    /**
     * Creates a form to delete a demandeOM entity.
     *
     * @param DemandeOM $demandeOM The demandeOM entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DemandeOM $demandeOM)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisateur_demande-om_delete', array('id' => $demandeOM->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
