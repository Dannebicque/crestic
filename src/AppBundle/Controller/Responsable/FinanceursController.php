<?php

namespace AppBundle\Controller\Responsable;

use AppBundle\Entity\Financeurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Financeurs controller.
 *
 * @Route("responsable/financeurs")
 */
class FinanceursController extends Controller
{
    /**
     * Lists all financeur entities.
     *
     * @Route("/", name="responsable_financeurs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $financeurs = $em->getRepository('AppBundle:Financeurs')->findAll();

        return $this->render('@App/Responsable/financeurs/index.html.twig', array(
            'financeurs' => $financeurs,
        ));
    }

    /**
     * Creates a new financeur entity.
     *
     * @Route("/new", name="responsable_financeurs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $financeur = new Financeurs();
        $form       = $this->createForm('AppBundle\Form\FinanceursType', $financeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($financeur);
            $em->flush();

            return $this->redirectToRoute('responsable_financeurs_show', array('id' => $financeur->getId()));
        }

        return $this->render('@App/Responsable/financeurs/new.html.twig', array(
            'financeur' => $financeur,
            'form'       => $form->createView(),
        ));
    }

    /**
     * Finds and displays a financeurs entity.
     *
     * @Route("/{id}", name="responsable_financeurs_show")
     * @Method("GET")
     */
    public function showAction(Financeurs $financeur)
    {

        return $this->render('@App/Responsable/financeurs/show.html.twig', array(
            'financeur'  => $financeur,
        ));
    }

    /**
     * Displays a form to edit an existing financeurs entity.
     *
     * @Route("/{id}/edit", name="responsable_financeurs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Financeurs $financeur)
    {
        $editForm   = $this->createForm('AppBundle\Form\FinanceursType', $financeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('responsable_financeurs_edit', array('id' => $financeur->getId()));
        }

        return $this->render('@App/Responsable/financeurs/edit.html.twig', array(
            'financeur'  => $financeur,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
