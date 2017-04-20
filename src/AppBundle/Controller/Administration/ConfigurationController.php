<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Configuration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Configuration controller.
 *
 * @Route("/administration/configuration")
 */
class ConfigurationController extends Controller
{
    /**
     * Lists all configuration entities.
     *
     * @Route("/", name="administration_configuration_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $configurations = $em->getRepository('AppBundle:Configuration')->findAll();

        return $this->render('@App/Administration/configuration/index.html.twig', array(
            'configurations' => $configurations,
        ));
    }

    /**
     * Creates a new configuration entity.
     *
     * @Route("/new", name="administration_configuration_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $config = new Configuration();
        $form = $this->createForm('AppBundle\Form\ConfigurationType', $config);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($config);
            $em->flush();

            return $this->redirectToRoute('administration_configuration_show', array('id' => $config->getId()));
        }

        return $this->render('@App/Administration/configuration/new.html.twig', array(
            'config' => $config,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a configuration entity.
     *
     * @Route("/{id}", name="administration_configuration_show")
     * @Method("GET")
     */
    public function showAction(Configuration $config)
    {
        $deleteForm = $this->createDeleteForm($config);

        return $this->render('@App/Administration/configuration/show.html.twig', array(
            'config' => $config,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing configuration entity.
     *
     * @Route("/{id}/edit", name="administration_configuration_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Configuration $config)
    {
        $editForm = $this->createForm('AppBundle\Form\ConfigurationType', $config);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_configuration_edit', array('id' => $config->getId()));
        }

        return $this->render('@App/Administration/configuration/edit.html.twig', array(
            'config' => $config,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a configuration entity.
     *
     * @Route("/{id}", name="administration_configuration_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Configuration $configuration)
    {
        $form = $this->createDeleteForm($configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($configuration);
            $em->flush();
        }

        return $this->redirectToRoute('administration_configuration_index');
    }

    /**
     * Creates a form to delete a configuration entity.
     *
     * @param Configuration $configuration The configuration entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Configuration $configuration)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_configuration_delete', array('id' => $configuration->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
