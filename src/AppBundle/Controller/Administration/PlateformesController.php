<?php

namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Plateformes;
use AppBundle\Entity\PlateformesHasSliders;
use AppBundle\Entity\ProjetsHasPlateformes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Plateforme controller.
 *
 * @Route("/administration/plateformes")
 */
class PlateformesController extends Controller
{
    /**
     * Lists all plateforme entities.
     *
     * @Route("/", name="administration_plateformes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plateformes = $em->getRepository('AppBundle:Plateformes')->findAll();

        return $this->render('@App/Administration/plateformes/index.html.twig', array(
            'plateformes' => $plateformes,
        ));
    }

    /**
     * Creates a new plateforme entity.
     *
     * @Route("/new", name="administration_plateformes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plateforme = new Plateformes();
        $form = $this->createForm('AppBundle\Form\PlateformesType', $plateforme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plateforme);
            $em->flush();

            return $this->redirectToRoute('administration_plateformes_show', array('id' => $plateforme->getId()));
        }

        return $this->render('@App/Administration/plateformes/new.html.twig', array(
            'plateforme' => $plateforme,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plateforme entity.
     *
     * @Route("/{id}", name="administration_plateformes_show")
     * @Method("GET")
     */
    public function showAction(Plateformes $plateforme)
    {
        $deleteForm = $this->createDeleteForm($plateforme);

        return $this->render('@App/Administration/plateformes/show.html.twig', array(
            'plateforme' => $plateforme,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plateforme entity.
     *
     * @Route("/{id}/edit", name="administration_plateformes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Plateformes $plateforme)
    {
        $editForm = $this->createForm('AppBundle\Form\PlateformesType', $plateforme);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'Modifications enregistrées');

            return $this->redirectToRoute('administration_plateformes_edit', array('id' => $plateforme->getId()));
        }

        return $this->render('@App/Administration/plateformes/edit.html.twig', array(
            'plateforme' => $plateforme,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a plateforme entity.
     *
     * @Route("/{id}", name="administration_plateformes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Plateformes $plateforme)
    {
        $form = $this->createDeleteForm($plateforme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plateforme);
            $em->flush();
        }

        return $this->redirectToRoute('administration_plateformes_index');
    }

    /**
     * Creates a form to delete a plateforme entity.
     *
     * @param Plateformes $plateforme The plateforme entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Plateformes $plateforme)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administration_plateformes_delete', array('id' => $plateforme->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @param Plateformes $id
     * @Route("/{id}/plateformes", name="administration_plateformes_options")
     * @return Response
     */
    public function plateformeOptionsAction(Plateformes $id)
    {
        $t = array();

        /** @var ProjetsHasPlateformes $membre */
        foreach ($id->getProjets() as $projet)
        {
            $t['projets'][$projet->getProjet()->getId()] = $projet;
        }

        /** @var PlateformesHasSliders $slider */
        foreach ($id->getSliders() as $slider)
        {
            $t['sliders'][$slider->getSlider()->getId()] = $slider;
        }


        return $this->render('@App/Administration/plateformes/options.html.twig', array(
            'plateforme'      => $id,
            't'           => $t,
            'projets' => $this->getDoctrine()->getRepository('AppBundle:Projets')->findAllProjets(),
            'sliders'     => $this->getDoctrine()->getRepository('AppBundle:Slider')->findAllSlider(),
        ));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/membre", name="administration_plateformes_ajax_option_add", methods={"POST"})
     */
    public function projetOptionAjaxAction(Request $request)
    {
        $idprojet = $request->request->get('projet');
        $idoption = $request->request->get('idoption');
        $type     = $request->request->get('type');


        $projet = $this->getDoctrine()->getRepository('AppBundle:Projets')->find($idprojet);

        switch ($type)
        {
            case 'membre':
                $option       = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasMembres')->findBy(array('membreCrestic' => $idoption, 'projet' => $idprojet));
                $e_m          = new ProjetsHasMembres();
                $set          = 'setMembreCrestic';
                $texte        = '';
                break;
            case 'equipe':
                $option       = $this->getDoctrine()->getRepository('AppBundle:Equipes')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasEquipes')->findBy(array('equipe' => $idoption, 'projet' => $idprojet));
                $e_m          = new ProjetsHasEquipes();
                $set          = 'setEquipe';
                $texte        = '';
                break;
            case 'partenaire':
                $option       = $this->getDoctrine()->getRepository('AppBundle:Partenaires')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPartenaires')->findBy(array('partenaire' => $idoption, 'projet' => $idprojet));
                $e_m          = new ProjetsHasPartenaires();
                $set          = 'setPartenaire';
                $texte        = '';
                break;
            case 'slider':
                $option       = $this->getDoctrine()->getRepository('AppBundle:Slider')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasSliders')->findBy(array('slider' => $idoption, 'projet' => $idprojet));
                $e_m          = new ProjetsHasSliders();
                $set          = 'setSlider';
                $texte        = '';
                break;
            case 'plateforme':
                $option       = $this->getDoctrine()->getRepository('AppBundle:Plateformes')->find($idoption);
                $projetoption = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPlateformes')->findBy(array('plateforme' => $idoption, 'projet' => $idprojet));
                $e_m          = new ProjetsHasPlateformes();
                $set          = 'setPlateforme';
                $texte        = '';
                break;
        }


        if ($projet && $option && count($projetoption) == 0)
        {
            $e_m->setProjet($projet);
            $e_m->$set($option);
            $em = $this->getDoctrine()->getManager();
            $em->persist($e_m);
            $em->flush();
            return new Response($texte, 200);
        } else
        {
            return new Response('nok', 500);
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax/membrer", name="administration_plateforme_ajax_option_remove", methods={"POST"})
     */
    public function plateformeMembreAjaxRemoveAction(Request $request)
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
