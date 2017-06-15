<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\MembresCrestic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Membrescrestic controller.
 *
 * @Route("/administration/membres")
 */
class MembresCresticController extends Controller
{
    /**
     * Lists all membresCrestic entities.
     *
     * @Route("/", name="administration_membres_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membresCrestics = $em->getRepository('AppBundle:MembresCrestic')->findAll();

        return $this->render('@App/Administration/membrescrestic/index.html.twig', array(
            'membresCrestics' => $membresCrestics,
        ));
    }

    /**
     * Creates a new membresCrestic entity.
     *
     * @Route("/new", name="administration_membres_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $membresCrestic = new Membrescrestic();
        $form = $this->createForm('AppBundle\Form\MembresCresticType', $membresCrestic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $userManager = $this->get('fos_user.user_manager');
            $fuser = $userManager->createUser();
            $tokenGenerator = $this->get('fos_user.util.token_generator');
            $password = substr($tokenGenerator->generateToken(), 0, 8); // 8 chars
            $fuser->setPlainPassword($password);
            $fuser->setEmail($membresCrestic->getEmail());
            $fuser->setNom($membresCrestic->getNom());
            $fuser->setUsername($membresCrestic->getUsername());
            $fuser->setPrenom($membresCrestic->getPrenom());
            $fuser->setEnabled(true);//rendre actif le compte. Par défaut inactif
            $fuser->setRoles(array($membresCrestic->getRole())); //permet de définir le rôle par défaut

            $userManager->updateUser($fuser);

            $em->flush();

            $this->get('my.mailer')->sendMailFirstConnexion($fuser, $password);

            return $this->redirectToRoute('administration_membres_show_light', array('id' => $fuser->getId()));
        }

        return $this->render('@App/Administration/membrescrestic/new.html.twig', array(
            'membresCrestic' => $membresCrestic,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a membresCrestic entity.
     *
     * @Route("/{id}", name="administration_membres_show")
     * @Method("GET")
     */
    public function showAction(MembresCrestic $membresCrestic)
    {
        $deleteForm = $this->createDeleteForm($membresCrestic);

        return $this->render('@App/Administration/membrescrestic/show.html.twig', array(
            'membresCrestic' => $membresCrestic,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a membresCrestic entity.
     *
     * @Route("/new/{id}", name="administration_membres_show_light")
     * @Method("GET")
     */
    public function showLightAction(MembresCrestic $membresCrestic)
    {
        $deleteForm = $this->createDeleteForm($membresCrestic);

        return $this->render('@App/Administration/membrescrestic/show_light.html.twig', array(
            'membresCrestic' => $membresCrestic,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing membresCrestic entity.
     *
     * @Route("/{id}/edit", name="administration_membres_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MembresCrestic $membresCrestic)
    {
        $deleteForm = $this->createDeleteForm($membresCrestic);
        $editForm = $this->createForm('AppBundle\Form\MembresCresticType', $membresCrestic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_membres_edit', array('id' => $membresCrestic->getId()));
        }

        return $this->render('@App/Administration/membrescrestic/edit.html.twig', array(
            'membresCrestic' => $membresCrestic,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a membresCrestic entity.
     *
     * @Route("/{id}", name="administration_membres_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MembresCrestic $membresCrestic)
    {
        $form = $this->createDeleteForm($membresCrestic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($membresCrestic);
            $em->flush();
        }

        return $this->redirectToRoute('administration_membres_index');
    }

    /**
     * Creates a form to delete a membresCrestic entity.
     *
     * @param MembresCrestic $membresCrestic The membresCrestic entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MembresCrestic $membresCrestic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_membres_delete', array('id' => $membresCrestic->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
