<?php

namespace AppBundle\Controller\Responsable;

use AppBundle\Entity\Partenaires;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Partenaire controller.
 *
 * @Route("/espace-responsable/partenaires")
 */
class PartenairesController extends Controller
{
    /**
     * Lists all partenaire entities.
     *
     * @Route("/", name="responsable_partenaires_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partenaires = $em->getRepository('AppBundle:Partenaires')->findAll();

        return $this->render('@App/Responsable/partenaires/index.html.twig', array(
            'partenaires' => $partenaires,
        ));
    }

    /**
     * Creates a new partenaire entity.
     *
     * @Route("/new", name="responsable_partenaires_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $partenaire = new Partenaires();
        $form       = $this->createForm('AppBundle\Form\PartenairesType', $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partenaire);
            $em->flush();

            return $this->redirectToRoute('responsable_partenaires_show', array('id' => $partenaire->getId()));
        }

        return $this->render('@App/Responsable/partenaires/new.html.twig', array(
            'partenaire' => $partenaire,
            'form'       => $form->createView(),
        ));
    }

    /**
     * Finds and displays a partenaire entity.
     *
     * @Route("/{id}", name="responsable_partenaires_show")
     * @Method("GET")
     * @param Partenaires $partenaire
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(Partenaires $partenaire)
    {
        return $this->render('@App/Responsable/partenaires/show.html.twig', array(
            'partenaire'  => $partenaire,
        ));
    }

    /**
     * Displays a form to edit an existing partenaire entity.
     *
     * @Route("/{id}/edit", name="responsable_partenaires_edit")
     * @Method({"GET", "POST"})
     * @param Request     $request
     * @param Partenaires $partenaire
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Partenaires $partenaire)
    {
        $editForm   = $this->createForm('AppBundle\Form\PartenairesType', $partenaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('responsable_partenaires_edit', array('id' => $partenaire->getId()));
        }

        return $this->render('@App/Responsable/partenaires/edit.html.twig', array(
            'partenaire'  => $partenaire,
            'edit_form'   => $editForm->createView(),
        ));
    }

}
