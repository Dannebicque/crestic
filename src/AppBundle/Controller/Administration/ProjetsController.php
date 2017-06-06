<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Plateformes;
use AppBundle\Entity\Projets;
use AppBundle\Entity\ProjetsHasMembres;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Projet controller.
 *
 * @Route("/administration/projets")
 */
class ProjetsController extends Controller
{
    /**
     * Lists all projet entities.
     *
     * @Route("/", name="administration_projets_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('AppBundle:Projets')->findAll();

        return $this->render('@App/Administration/projets/index.html.twig', array(
            'projets' => $projets,
        ));
    }

    /**
     * Creates a new projet entity.
     *
     * @Route("/new", name="administration_projets_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $projet = new Projets();
        $form = $this->createForm('AppBundle\Form\ProjetsType', $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projet);
            $em->flush();

            return $this->redirectToRoute('administration_projets_show', array('id' => $projet->getId()));
        }

        return $this->render('@App/Administration/projets/new.html.twig', array(
            'projet' => $projet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projet entity.
     *
     * @Route("/{id}", name="administration_projets_show")
     * @Method("GET")
     */
    public function showAction(Projets $projet)
    {
        $deleteForm = $this->createDeleteForm($projet);

        return $this->render('@App/Administration/projets/show.html.twig', array(
            'projet' => $projet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projet entity.
     *
     * @Route("/{id}/edit", name="administration_projets_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Projets $projet)
    {
        $editForm = $this->createForm('AppBundle\Form\ProjetsType', $projet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_projets_edit', array('id' => $projet->getId()));
        }

        return $this->render('@App/Administration/projets/edit.html.twig', array(
            'projet' => $projet,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a projet entity.
     *
     * @Route("/{id}", name="administration_projets_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Projets $projet)
    {
        $form = $this->createDeleteForm($projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projet);
            $em->flush();
        }

        return $this->redirectToRoute('administration_projets_index');
    }

    /**
     * Creates a form to delete a projet entity.
     *
     * @param Projets $projet The projet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Projets $projet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_projets_delete', array('id' => $projet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @param Projets $id
     * @Route("/{id}/projets", name="administration_projets_membres")
     * @return Response
     */
    public function projetMembresAction(Projets $id)
    {
        $t = array();

        /** @var ProjetsHasMembres $membre */
        foreach ($id->getMembres() as $membre) {
            $t[$membre->getMembreCrestic()->getId()] = $membre;
        }

        return $this->render('@App/Administration/projets/membres.html.twig', array(
            'projet' => $id,
            't' => $t,
            'membres' => $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAllMembresCrestic(),
        ));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/membre", name="administration_projets_ajax_membre", methods={"POST"})
     */
    public function projetMembreAjaxAction(Request $request)
    {
        $idprojet = $request->request->get('projet');
        $idmembre = $request->request->get('membre');

        $projet = $this->getDoctrine()->getRepository('AppBundle:Projets')->find($idprojet);
        $membre = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($idmembre);
        $projetmembre = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasMembres')->findBy(array('membreCrestic' => $idmembre, 'projet' => $idprojet));

        if ($projet && $membre && count($projetmembre) == 0) {
            $e_m = new ProjetsHasMembres();
            $e_m->setProjet($projet);
            $e_m->setMembreCrestic($membre);
            $em = $this->getDoctrine()->getManager();
            $em->persist($e_m);
            $em->flush();
            return new Response('ok', 200);
        } else {
            return new Response('nok', 500);
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/membrer", name="administration_projets_ajax_membre_remove", methods={"POST"})
     */
    public function projetMembreAjaxRemoveAction(Request $request)
    {
        $idprojet = $request->request->get('projet');
        $idmembre = $request->request->get('membre');

        $projetmembre = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasMembres')->findBy(array('membreCrestic' => $idmembre, 'projet' => $idprojet));


        $em = $this->getDoctrine()->getManager();
        foreach ($projetmembre as $e)
        {
            $em->remove($e);
        }
        $em->flush();
        return new Response('ok', 200);
    }
}
