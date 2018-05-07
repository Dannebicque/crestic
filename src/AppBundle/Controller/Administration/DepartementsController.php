<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Departements;
use AppBundle\Entity\EquipesHasDepartements;
use AppBundle\Entity\MembresCrestic;
use AppBundle\Entity\MembresHasDepartements;
use AppBundle\Form\DepartementsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Departement controller.
 *
 * @Route("administration/departements")
 */
class DepartementsController extends Controller
{
    /**
     * Lists all departement entities.
     *
     * @Route("/", name="administration_departements_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departements = $em->getRepository('AppBundle:Departements')->findAll();

        return $this->render('@App/Administration/departements/index.html.twig', array(
            'departements' => $departements,
        ));
    }

    /**
     * Creates a new departement entity.
     *
     * @Route("/new", name="administration_departements_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $departement = new Departements();
        $form        = $this->createForm(DepartementsType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($departement);
            $em->flush();

            return $this->redirectToRoute('administration_departements_show', array('id' => $departement->getId()));
        }

        return $this->render('@App/Administration/departements/new.html.twig', array(
            'departement' => $departement,
            'form'        => $form->createView(),
        ));
    }

    /**
     * Finds and displays a departement entity.
     *
     * @Route("/{id}", name="administration_departements_show")
     * @Method("GET")
     * @param Departements $departement
     * @return \Symfony\Component\HttpFoundation\Response
*/
    public function showAction(Departements $departement)
    {
        $deleteForm = $this->createDeleteForm($departement);

        return $this->render('@App/Administration/departements/show.html.twig', array(
            'departement' => $departement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing departement entity.
     *
     * @Route("/{id}/edit", name="administration_departements_edit")
     * @Method({"GET", "POST"})
     * @param Request      $request
     * @param Departements $departement
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
*/
    public function editAction(Request $request, Departements $departement)
    {
        $deleteForm = $this->createDeleteForm($departement);
        $editForm   = $this->createForm(DepartementsType::class, $departement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administration_departements_edit', array('id' => $departement->getId()));
        }

        return $this->render('@App/Administration/departements/edit.html.twig', array(
            'departement' => $departement,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a departement entity.
     *
     * @Route("/{id}", name="administration_departements_delete")
     * @Method("DELETE")
     * @param Request      $request
     * @param Departements $departement
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
*/
    public function deleteAction(Request $request, Departements $departement)
    {
        $form = $this->createDeleteForm($departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($departement);
            $em->flush();
        }

        return $this->redirectToRoute('administration_departements_index');
    }

    /**
     * Creates a form to delete a departement entity.
     *
     * @param Departements $departement The departement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Departements $departement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_departements_delete', array('id' => $departement->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param Departements $id
     * @Route("/{id}/departements", name="administration_departements_options")
     * @return Response
     */
    public function departementOptionsAction(Departements $id)
    {
        $t = array();

        /** @var MembresHasDepartements $membre */
        foreach ($id->getMembres() as $membre)
        {
            $t['membres'][$membre->getId()] = $membre;
        }

        /** @var EquipesHasDepartements $equipe */
        foreach ($id->getEquipes() as $equipe)
        {
            $t['equipes'][$equipe->getEquipe()->getId()] = $equipe;
        }

        return $this->render('@App/Administration/departements/options.html.twig', array(
            'departement'      => $id,
            't'           => $t,
            'membres'     => $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAllMembresCrestic(),
            'equipes'     => $this->getDoctrine()->getRepository('AppBundle:Equipes')->findAllEquipes(),


        ));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/add/option", name="administration_departements_ajax_option_add", methods={"POST"})
     */
    public function departementOptionAjaxAction(Request $request)
    {
        $iddepartement = $request->request->get('departement');
        $idoption = $request->request->get('idoption');
        $type     = $request->request->get('type');


        $departement = $this->getDoctrine()->getRepository('AppBundle:Departements')->find($iddepartement);

        switch ($type)
        {
            case 'membre':
                $option       = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($idoption);
                $departementoption = $this->getDoctrine()->getRepository('AppBundle:MembresHasDepartements')->findBy(array('membre' => $idoption, 'departement' => $iddepartement));
                $e_m          = new MembresHasDepartements();
                $set          = 'setMembre';
                $texte        = 'Membre associé au département';
                break;
            case 'equipe':
                $option       = $this->getDoctrine()->getRepository('AppBundle:Equipes')->find($idoption);
                $departementoption = $this->getDoctrine()->getRepository('AppBundle:EquipesHasDepartements')->findBy(array('equipe' => $idoption, 'departement' => $iddepartement));
                $e_m          = new EquipesHasDepartements();
                $set          = 'setEquipe';
                $texte        = 'Equipe associée au département';
                break;
            default:
                $e_m          = null;
                $option       = false;
                $departementoption = null;
                $texte        = 'Erreur';
                $set          = '';
        }


        if ($departement && $option && count($departementoption) == 0 && $e_m !== null)
        {
            $e_m->setDepartement($departement);
            $e_m->$set($option);
            $em = $this->getDoctrine()->getManager();
            $em->persist($e_m);
            $em->flush();
            return new Response($texte, 200);
        }
        return new Response('Erreur lors de la modification des options du département', 500);

    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/remove/option", name="administration_departements_ajax_option_remove", methods={"POST"})
     */
    public function departementMembreAjaxRemoveAction(Request $request)
    {
        $iddepartement = $request->request->get('departement');
        $idoption = $request->request->get('idoption');
        $type     = $request->request->get('type');


        $departement = $this->getDoctrine()->getRepository('AppBundle:Departements')->find($iddepartement);

        switch ($type)
        {
            case 'membre':
                $departementoption = $this->getDoctrine()->getRepository('AppBundle:MembresHasDepartements')->findBy(array('membre' => $idoption, 'departement' => $iddepartement));
                $texte        = 'Membre retiré du département';
                break;
            case 'equipe':
                $departementoption = $this->getDoctrine()->getRepository('AppBundle:EquipesHasDepartements')->findBy(array('equipe' => $idoption, 'departement' => $iddepartement));
                $texte        = 'Equipe retirée du département';
                break;
            default:
                $departementoption = null;
                $texte        = 'Rien à retirer';
                break;
        }


        if (count($departementoption) > 0)
        {
            $em = $this->getDoctrine()->getManager();
            foreach ($departementoption as $p)
            {
                $em->remove($p);
            }
            $em->flush();
            return new Response($texte, 200);
        } else
        {
            return new Response('Erreur lors de la modification des options du département', 500);
        }
    }
}
