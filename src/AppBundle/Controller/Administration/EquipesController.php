<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Equipes;
use AppBundle\Entity\EquipesHasMembres;
use AppBundle\Entity\MembresCrestic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Equipe controller.
 *
 * @Route("administration/equipes")
 */
class EquipesController extends Controller
{
    /**
     * Lists all equipe entities.
     *
     * @Route("/", name="administration_equipes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipes = $em->getRepository('AppBundle:Equipes')->findAll();

        return $this->render('@App/Administration/equipes/index.html.twig', array(
            'equipes' => $equipes,
        ));
    }

    /**
     * Creates a new equipe entity.
     *
     * @Route("/new", name="administration_equipes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $equipe = new Equipes();
        $form = $this->createForm('AppBundle\Form\EquipesType', $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush();

            return $this->redirectToRoute('administration_equipes_show', array('id' => $equipe->getId()));
        }

        return $this->render('@App/Administration/equipes/new.html.twig', array(
            'equipe' => $equipe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipe entity.
     *
     * @Route("/{id}", name="administration_equipes_show")
     * @Method("GET")
     */
    public function showAction(Equipes $equipe)
    {
        $deleteForm = $this->createDeleteForm($equipe);

        return $this->render('@App/Administration/equipes/show.html.twig', array(
            'equipe' => $equipe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipe entity.
     *
     * @Route("/{id}/edit", name="administration_equipes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Equipes $equipe)
    {
        $editForm = $this->createForm('AppBundle\Form\EquipesType', $equipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_equipes_edit', array('id' => $equipe->getId()));
        }

        return $this->render('@App/Administration/equipes/edit.html.twig', array(
            'equipe' => $equipe,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a equipe entity.
     *
     * @Route("/{id}", name="administration_equipes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Equipes $equipe)
    {
        $form = $this->createDeleteForm($equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipe);
            $em->flush();
        }

        return $this->redirectToRoute('administration_equipes_index');
    }

    /**
     * Creates a form to delete a equipe entity.
     *
     * @param Equipes $equipe The equipe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipes $equipe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_equipes_delete', array('id' => $equipe->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param Equipes $id
     * @Route("/{id}/membres", name="administration_equipes_membres")
     * @return Response
     */
    public function equipeMembresAction(Equipes $id)
    {
        $t = array();

        /** @var EquipesHasMembres $membre */
        foreach ($id->getMembres() as $membre) {
            $t[$membre->getMembreCrestic()->getId()] = $membre;
        }

        return $this->render('@App/Administration/equipes/membres.html.twig', array(
            'equipe' => $id,
            't' => $t,
            'membres' => $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAllMembresCrestic(),
        ));
    }

    /**
     * @param Request $request
     * @return Response
     * @internal param Equipes $id
     * @Route("/ajax/membre", name="administration_equipes_ajax_membre", methods={"POST"})
     */
    public function equipeMembreAjaxAction(Request $request)
    {
        $idequipe = $request->request->get('equipe');
        $idmembre = $request->request->get('membre');

        $equipe = $this->getDoctrine()->getRepository('AppBundle:Equipes')->find($idequipe);
        $membre = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($idmembre);
        $equipemembre = $this->getDoctrine()->getRepository('AppBundle:EquipesHasMembres')->findBy(array('membreCrestic' => $idmembre, 'equipe' => $idequipe));

        if ($equipe && $membre && count($equipemembre) == 0) {
            $e_m = new EquipesHasMembres();
            $e_m->setEquipe($equipe);
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
     * @internal param Equipes $id
     * @Route("/ajax/membrer", name="administration_equipes_ajax_membre_remove", methods={"POST"})
     */
    public function equipeMembreAjaxRemoveAction(Request $request)
    {
        $idequipe = $request->request->get('equipe');
        $idmembre = $request->request->get('membre');

        $equipemembre = $this->getDoctrine()->getRepository('AppBundle:EquipesHasMembres')->findBy(array('membreCrestic' => $idmembre, 'equipe' => $idequipe));


        $em = $this->getDoctrine()->getManager();
        foreach ($equipemembre as $e)
        {
            $em->remove($e);
        }
        $em->flush();
        return new Response('ok', 200);
    }
}
