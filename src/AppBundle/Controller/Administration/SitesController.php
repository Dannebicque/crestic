<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Sites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Site controller.
 *
 * @Route("/administration/sites")
 */
class SitesController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/", name="administration_sites_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sites = $em->getRepository('AppBundle:Sites')->findAll();

        return $this->render('@App/Administration/sites/index.html.twig', array(
            'sites' => $sites,
        ));
    }

    /**
     * Creates a new site entity.
     *
     * @Route("/new", name="administration_sites_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $site = new Sites();
        $form = $this->createForm('AppBundle\Form\SitesType', $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($site);
            $em->flush();

            return $this->redirectToRoute('administration_sites_show', array('id' => $site->getId()));
        }

        return $this->render('@App/Administration/sites/new.html.twig', array(
            'site' => $site,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a site entity.
     *
     * @Route("/{id}", name="administration_sites_show")
     * @Method("GET")
     * @param Sites $site
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(Sites $site)
    {
        $deleteForm = $this->createDeleteForm($site);

        return $this->render('@App/Administration/sites/show.html.twig', array(
            'site'        => $site,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing site entity.
     *
     * @Route("/{id}/edit", name="administration_sites_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Sites   $site
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Sites $site)
    {
        $editForm = $this->createForm('AppBundle\Form\SitesType', $site);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_sites_edit', array('id' => $site->getId()));
        }

        return $this->render('@App/Administration/sites/edit.html.twig', array(
            'site'      => $site,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a site entity.
     *
     * @Route("/{id}", name="administration_sites_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Sites   $site
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, Sites $site)
    {
        $form = $this->createDeleteForm($site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($site);
            $em->flush();
        }

        return $this->redirectToRoute('administration_sites_index');
    }

    /**
     * Creates a form to delete a site entity.
     *
     * @param Sites $site The site entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sites $site)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_sites_delete', array('id' => $site->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
