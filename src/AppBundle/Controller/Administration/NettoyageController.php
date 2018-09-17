<?php

namespace AppBundle\Controller\Administration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NettoyageController
 * @package AppBundle\Controller
 * @Route("administration/nettoyage")
 */
class NettoyageController extends Controller
{
    /**
     * @Route("/clear/membres")
     */
    public function clearMembresAction()
    {
        $membres = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findAll();

        return $this->render('AppBundle:Nettoyage:clear_membres.html.twig', array(
            'membres' => $membres
        ));
    }

    /**
     * @Route("/clear/publications")
     */
    public function clearPublicationsAction()
    {
        $publications = $this->getDoctrine()->getRepository('AppBundle:Publications')->findAll();

        return $this->render('AppBundle:Nettoyage:clear_publications.html.twig', array(
            'publications' => $publications
        ));
    }

    /**
     * @Route("/clear/ext")
     */
    public function clearMembresExtAction()
    {
        $membres = $this->getDoctrine()->getRepository('AppBundle:MembresExterieurs')->findAll();

        return $this->render('AppBundle:Nettoyage:clear_membres_ext.html.twig', array(
            'membres' => $membres
        ));
    }

    /**
     * @Route("/update/membres", name="nettoyage_update_membre")
     */
    public function updateMembresAction(Request $request)
    {
        $membre = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($request->request->get('pk'));

        if ($membre !== null) {
            switch ($request->request->get('name')) {
                case 'nom':
                    $membre->setNom($request->request->get('value'));
                    break;
                case 'prenom':
                    $membre->setPrenom($request->request->get('value'));
                    break;
                case 'batiment':
                    $membre->setBatiment($request->request->get('value'));
                    break;
                case 'bureau':
                    $membre->setBureau($request->request->get('value'));
                    break;
                case 'adresse':
                    $membre->setAdresse($request->request->get('value'));
                    break;
                case 'email':
                    $membre->setEmail($request->request->get('value'));
                    break;
                case 'site':
                    $membre->setSite($request->request->get('value'));
                    break;
                case 'status':
                    $membre->setStatus($request->request->get('value'));
                    break;
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            return new Response('ok', 200);
        }

        return new Response('nok', 500);
    }


    /**
     * @Route("/update/publications", name="nettoyage_update_publication")
     * @param Request $request
     *
     * @return Response
     */
    public function updatePublicationsAction(Request $request)
    {
        $publi = $this->getDoctrine()->getRepository('AppBundle:Publications')->find($request->request->get('pk'));
        if ($publi !== null) {

            switch ($request->request->get('name')) {
                case 'titre':
                    $publi->setTitre($request->request->get('value'));
                    break;
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($publi);
            $em->flush();

            return new Response('ok', 200);
        }

        return new Response('nok', 500);
    }

    /**
     * @Route("/update/ext", name="nettoyage_update_membre_ext")
     */
    public function updateMembresExtAction(Request $request)
    {
        $membre = $this->getDoctrine()->getRepository('AppBundle:MembresExterieurs')->find($request->request->get('pk'));

        if ($membre !== null) {
            switch ($request->request->get('name')) {
                case 'nom':
                    $membre->setNom($request->request->get('value'));
                    break;
                case 'prenom':
                    $membre->setPrenom($request->request->get('value'));
                    break;
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            return new Response('ok', 200);
        }

        return new Response('nok', 500);
    }

}
