<?php

namespace AppBundle\Controller\Utilisateur;

use AppBundle\Entity\MembresCrestic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Membrescrestic controller.
 *
 * @Route("/espace-utilisateur/")
 */
class MembresCresticController extends Controller
{
    /**
     * Displays a form to edit an existing membresCrestic entity.
     *
     * @Route("edit", name="utilisateur_membres_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $membresCrestic = $this->getUser();
        $editForm       = $this->createForm('AppBundle\Form\MembresCresticUtilisateurType', $membresCrestic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('success', 'Modifications enregistrées');
            return $this->redirectToRoute('utilisateur_membres_edit');
        }

        return $this->render('@App/Utilisateur/membres/edit.html.twig', array(
            'membresCrestic' => $membresCrestic,
            'edit_form'      => $editForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing membresCrestic entity.
     *
     * @Route("edit/anglais", name="utilisateur_membres_edit_en")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editEnAction(Request $request)
    {
        $membresCrestic = $this->getUser();
        $editForm       = $this->createForm('AppBundle\Form\MembresCresticUtilisateurEnType', $membresCrestic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('success', 'Modifications enregistrées');
            return $this->redirectToRoute('utilisateur_membres_edit_en');
        }

        return $this->render('@App/Utilisateur/membres/edit_en.html.twig', array(
            'membresCrestic' => $membresCrestic,
            'edit_form'      => $editForm->createView(),
        ));
    }
}
