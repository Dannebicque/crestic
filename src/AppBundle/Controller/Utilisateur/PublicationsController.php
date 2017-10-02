<?php

namespace AppBundle\Controller\Utilisateur;

use AppBundle\Entity\DemandeOM;
use AppBundle\Entity\MembresCrestic;
use AppBundle\Entity\Publications;
use AppBundle\Entity\PublicationsBrevets;
use AppBundle\Entity\PublicationsChapitres;
use AppBundle\Entity\PublicationsConferences;
use AppBundle\Entity\PublicationsHabilitations;
use AppBundle\Entity\PublicationsHasEquipes;
use AppBundle\Entity\PublicationsHasMembres;
use AppBundle\Entity\PublicationsHasPlateformes;
use AppBundle\Entity\PublicationsHasProjets;
use AppBundle\Entity\PublicationsOuvrages;
use AppBundle\Entity\PublicationsRapports;
use AppBundle\Entity\PublicationsRevues;
use AppBundle\Entity\PublicationsTheses;
use AppBundle\Entity\Reseaux;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Publications controller.
 *
 * @Route("/espace-utilisateur/publications")
 */
class PublicationsController extends Controller
{
    /**
     * Lists all demandeOM entities.
     *
     * @Route("/", name="utilisateur_publications_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $pubRevues      = $this->getDoctrine()->getRepository('AppBundle:PublicationsRevues')->findByAuteurCrestic($user->getId());
        $pubBrevets     = $this->getDoctrine()->getRepository('AppBundle:PublicationsBrevets')->findByAuteurCrestic($user->getId());
        $pubChapitres   = $this->getDoctrine()->getRepository('AppBundle:PublicationsChapitres')->findByAuteurCrestic($user->getId());
        $pubConferences = $this->getDoctrine()->getRepository('AppBundle:PublicationsConferences')->findByAuteurCrestic($user->getId());
        $pubRapports    = $this->getDoctrine()->getRepository('AppBundle:PublicationsRapports')->findByAuteurCrestic($user->getId());
        $pubTheses      = $this->getDoctrine()->getRepository('AppBundle:PublicationsTheses')->findByAuteurCrestic($user->getId());
        $pubOuvrages    = $this->getDoctrine()->getRepository('AppBundle:PublicationsOuvrages')->findByAuteurCrestic($user->getId());


        return $this->render('@App/Utilisateur/publications/index.html.twig', array(
            'pubRevues'      => $pubRevues,
            'pubBrevets'     => $pubBrevets,
            'pubChapitres'   => $pubChapitres,
            'pubConferences' => $pubConferences,
            'pubRapports'    => $pubRapports,
            'pubTheses'      => $pubTheses,
            'pubOuvrages'    => $pubOuvrages,
        ));
    }

    /**
     * Creates a new demandeOM entity.
     *
     * @Route("/new/{type}", name="utilisateur_publications_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $type)
    {
        switch ($type)
        {
            case 'revue':
                $publication = new PublicationsRevues();
                $form        = $this->createForm('AppBundle\Form\PublicationsRevuesType', $publication);
                break;
            case 'conference':
                $publication = new PublicationsConferences();
                $form        = $this->createForm('AppBundle\Form\PublicationsConferencesType', $publication);
                break;
            case 'rapport':
                $publication = new PublicationsRapports();
                $form        = $this->createForm('AppBundle\Form\PublicationsRapportsType', $publication);
                break;
            case 'these':
                $publication = new PublicationsTheses();
                $form        = $this->createForm('AppBundle\Form\PublicationsThesesType', $publication);
                break;
            case 'brevet':
                $publication = new PublicationsBrevets();
                $form        = $this->createForm('AppBundle\Form\PublicationsBrevetsType', $publication);
                break;
            case 'ouvrage':
                $publication = new PublicationsOuvrages();
                $form        = $this->createForm('AppBundle\Form\PublicationsOuvragesType', $publication);
                break;
            case 'chapitre':
                $publication = new PublicationsChapitres();
                $form        = $this->createForm('AppBundle\Form\PublicationsChapitresType', $publication);
                break;
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);

            $pm = new PublicationsHasMembres();
            $pm->setPosition(1);
            $pm->setPublication($publication);
            $pm->setMembreCrestic($this->getUser());
            $em->persist($pm);
            $em->flush();

            return $this->redirectToRoute('utilisateur_publications_etape2', array('id' => $publication->getId()));
        }

        return $this->render('@App/Utilisateur/publications/new.html.twig', array(
            'publication' => $publication,
            'form'        => $form->createView(),
            'type'        => $type
        ));
    }

    /**
     * @param Publications $id
     * @route("/options/{id}", name="utilisateur_publications_etape2")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function optionsPublicationsAction(Publications $id)
    {
        $projets             = $this->getDoctrine()->getRepository('AppBundle:Projets')->findAll();
        $plateformes         = $this->getDoctrine()->getRepository('AppBundle:Plateformes')->findAll();
        $equipes             = $this->getDoctrine()->getRepository('AppBundle:Equipes')->findAllEquipesActives();
        $auteurs             = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findArrayAuteurs($id->getId(), $this->get('router'));
        $publiHasEquipes     = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasEquipes')->findAllIdEquipes($id->getId());
        $publiHasProjets     = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasProjets')->findAllIdProjets($id->getId());
        $publiHasPlateformes = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasPlateformes')->findAllIdPlateformes($id->getId());


        return $this->render('@App/Utilisateur/publications/options.html.twig', array(
            'projets'             => $projets,
            'plateformes'         => $plateformes,
            'equipes'             => $equipes,
            'publication'         => $id,
            'auteurs'             => $auteurs,
            'publiHasEquipes'     => $publiHasEquipes,
            'publiHasProjets'     => $publiHasProjets,
            'publiHasPlateformes' => $publiHasPlateformes,

        ));
    }

    /**
     * @param $lettre
     * @return JsonResponse
     * @Route("ajax/search/auteurs", name="ajax_search_auteur")
     */
    public function ajaxAuteurAction(Request $request)
    {
        $lettres    = $request->request->get('lettres');
        $auteurs    = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findByLettre($lettres);
        $auteursExt = $this->getDoctrine()->getRepository('AppBundle:MembresExterieurs')->findByLettre($lettres);

        $tjson = array();
        /** @var MembresCrestic $auteur */
        foreach ($auteurs as $auteur)
        {
            $t['id']     = $auteur->getId();
            $t['nom']    = $auteur->getNom();
            $t['prenom'] = $auteur->getPrenom();
            $t['status'] = $auteur->getStatus();
            $t['type']   = 'crestic';
            $tjson[]     = $t;
        }

        foreach ($auteursExt as $auteur)
        {
            $t['id']     = $auteur->getId();
            $t['nom']    = $auteur->getNom();
            $t['prenom'] = $auteur->getPrenom();
            $t['status'] = 'extérieur';
            $t['type']   = 'ext';
            $tjson[]     = $t;
        }

        return new JsonResponse($tjson, 200);
    }

    /**
     * @param $lettre
     * @return JsonResponse
     * @Route("ajax/add/auteur", name="ajax_add_auteur")
     */
    public function ajaxAddAuteurAction(Request $request)
    {
        $idauteur      = $request->request->get('auteur');
        $type          = $request->request->get('type');
        $idpublication = $request->request->get('publication');

        if ($type == 'crestic')
        {
            $auteur = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($idauteur);
        } elseif ($type == 'ext')
        {
            $auteur = $this->getDoctrine()->getRepository('AppBundle:MembresExterieurs')->find($idauteur);
        } else
        {
            $auteur = false;
        }

        $publication = $this->getDoctrine()->getRepository('AppBundle:Publications')->find($idpublication);

        if ($auteur && $publication)
        {
            $maxAuteur = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findBy(array('publication' => $idpublication));

            $em = $this->getDoctrine()->getManager();
            $pm = new PublicationsHasMembres();

            if ($type == 'crestic')
            {
                $pm->setMembreCrestic($auteur);
            } else
            {
                $pm->setMembreExterieur($auteur);
            }

            $pm->setPublication($publication);
            $pm->setPosition(count($maxAuteur) + 1);
            $em->persist($pm);
            $em->flush();

            $auteurs = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findArrayAuteurs($idpublication, $this->get('router'));

            return new JsonResponse($auteurs, 200);
        } else
        {

        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("ajax/add/options", name="ajax_add_options")
     */
    public function ajaxOptionsAction(Request $request)
    {
        $type          = $request->request->get('type');
        $id            = $request->request->get('id');
        $valeur        = $request->request->get('valeur');
        $idpublication = $request->request->get('publication');

        $publication = $this->getDoctrine()->getRepository('AppBundle:Publications')->find($idpublication);
        if ($publication)
        {
            $em = $this->getDoctrine()->getManager();
            switch ($type)
            {
                case 'equipe':
                    $equipe = $this->getDoctrine()->getRepository('AppBundle:Equipes')->find($id);
                    if ($equipe)
                    {
                        if ($valeur == 'add')
                        {
                            $pe = new PublicationsHasEquipes();
                            $pe->setPublication($publication);
                            $pe->setEquipe($equipe);
                            $em->persist($pe);
                        } else
                        {
                            $pe = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasEquipes')->findBy(array('publication' => $publication->getId(), 'equipe' => $equipe->getId()));
                            foreach ($pe as $p)
                            {
                                $em->remove($p);
                            }
                        }
                    }
                    break;

                case 'projet':
                    $projet = $this->getDoctrine()->getRepository('AppBundle:Projets')->find($id);
                    if ($projet)
                    {
                        if ($valeur == 'add')
                        {
                            $pe = new PublicationsHasProjets();
                            $pe->setPublication($publication);
                            $pe->setProjet($projet);
                            $em->persist($pe);
                        } else
                        {
                            $pe = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasProjets')->findBy(array('publication' => $publication->getId(), 'projet' => $projet->getId()));
                            foreach ($pe as $p)
                            {
                                $em->remove($p);
                            }
                        }
                    }
                    break;

                case 'plateforme':
                    $plateforme = $this->getDoctrine()->getRepository('AppBundle:Plateformes')->find($id);
                    if ($plateforme)
                    {
                        if ($valeur == 'add')
                        {
                            $pe = new PublicationsHasPlateformes();
                            $pe->setPublication($publication);
                            $pe->setPlateforme($plateforme);
                            $em->persist($pe);
                        } else
                        {
                            $pe = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasPlateformes')->findBy(array('publication' => $publication->getId(), 'plateforme' => $plateforme->getId()));
                            foreach ($pe as $p)
                            {
                                $em->remove($p);
                            }
                        }
                    }
                    break;
            }
            $em->flush();
        }

        return new JsonResponse();
    }

    /**
     * @param Request $request
     * @Route("ajax/suppr/auteur", name="ajax_suppr_auteur")
     * @return Response
     */
    public function ajaxSupprAuteurAction(Request $request)
    {
        $type          = $request->request->get('type');
        $id            = $request->request->get('id');
        $idpublication = $request->request->get('publication');
        if ($type == 'crestic')
        {
            $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findOneBy(array('publication' => $idpublication, 'membreCrestic' => $id));
        } elseif ($type == 'ext')
        {
            $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findOneBy(array('publication' => $idpublication, 'membreExterieur' => $id));
        } else
        {
            //erreur
            return new Response('erreur', 500);
        }

        if ($publication)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publication);
            $em->flush();
            //todo: gérer la numérotation
            return new Response('ok', 200);

        } else
        {
            //erreur
            return new Response('erreur', 500);
        }
    }

    /**
     * @param Request $request
     * @param         $id
     * @param         $type
     *
     * @Route("/edit/{type}/{id}/", name="utilisateur_publication_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id, $type)
    {
        switch ($type)
        {
            case 'revue':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsRevues')->find($id);
                $form        = $this->createForm('AppBundle\Form\PublicationsRevuesType', $publication);
                break;
            case 'conference':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsConferences')->find($id);
                $form        = $this->createForm('AppBundle\Form\PublicationsConferencesType', $publication);
                break;
            case 'rapport':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsRapports')->find($id);
                $form        = $this->createForm('AppBundle\Form\PublicationsRapportsType', $publication);
                break;
            case 'these':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsTheses')->find($id);
                $form        = $this->createForm('AppBundle\Form\PublicationsThesesType', $publication);
                break;
            case 'brevet':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsBrevets')->find($id);
                $form        = $this->createForm('AppBundle\Form\PublicationsBrevetsType', $publication);
                break;
            case 'ouvrage':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsOuvrages')->find($id);
                $form        = $this->createForm('AppBundle\Form\PublicationsOuvragesType', $publication);
                break;
            case 'chapitre':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsChapitres')->find($id);
                $form        = $this->createForm('AppBundle\Form\PublicationsChapitresType', $publication);
                break;
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();

            return $this->redirectToRoute('utilisateur_publications_etape2', array('id' => $publication->getId()));
        }

        return $this->render('@App/Utilisateur/publications/edit.html.twig', array(
            'publication' => $publication,
            'form'        => $form->createView(),
            'type'        => $type
        ));
    }

    /**
     * @param $id
     * @param $type
     * @Route("/show/{type}/{id}", name="utilisateur_publication_show")
     * @Method({"GET"})
     * @return Response
     */
    public function showAction($id, $type)
    {
        $publication         = $this->getPublicationFromType($id, $type);
        $publiHasEquipes     = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasEquipes')->findAllPublicationsFromEquipe($publication->getId());
        $publiHasProjets     = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasProjets')->findAllPublicationsFromProjet($publication->getId());
        $publiHasPlateformes = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasPlateformes')->findAllPlateformesFromPublication($publication->getId());

        return $this->render('AppBundle:Utilisateur/publications:show.html.twig', array(
            'publication' => $publication,
            'equipes'     => $publiHasEquipes,
            'projets'     => $publiHasProjets,
            'plateformes' => $publiHasPlateformes,
        ));
    }

    private function getPublicationFromType($id, $type)
    {
        switch ($type)
        {
            case 'revue':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsRevues')->find($id);
                break;
            case 'conference':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsConferences')->find($id);
                break;
            case 'rapport':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsRapports')->find($id);
                break;
            case 'these':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsTheses')->find($id);
                break;
            case 'brevet':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsBrevets')->find($id);
                break;
            case 'ouvrage':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsOuvrages')->find($id);
                break;
            case 'chapitre':
                $publication = $this->getDoctrine()->getRepository('AppBundle:PublicationsChapitres')->find($id);
                break;
        }

        return $publication;
    }

    /**
     * @param $auteur
     * @param $publication
     * @Route("ajax/up-down/auteur/", name="ajax_publication_up_down")
     */
    public function upDownAuteur(Request $request)
    {
        $idauteur    = $request->request->get('auteur');
        $publication = $request->request->get('publication');
        $sens        = $request->request->get('sens');

        $auteurs = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findAllMembresFromPublication($publication);
        $em      = $this->getDoctrine()->getManager();

        $t = array();

        /** @var PublicationsHasMembres $a */
        foreach ($auteurs as $a)
        {
            $t[$a->getPosition()] = $a;
            if (($a->getMembreExterieur() != null && $a->getMembreExterieur()->getId() == $idauteur) || ($a->getMembreCrestic() != null && $a->getMembreCrestic()->getId() == $idauteur))
            {
                $auteur = $a;
            }
        }

        if ($sens == 'down')
        {
            $temp                          = $t[$auteur->getPosition()];
            $t[$auteur->getPosition()]     = $t[$auteur->getPosition() + 1];
            $t[$auteur->getPosition() + 1] = $temp;
        } elseif ($sens == 'up')
        {
            $temp                          = $t[$auteur->getPosition()];
            $t[$auteur->getPosition()]     = $t[$auteur->getPosition() - 1];
            $t[$auteur->getPosition() - 1] = $temp;
        }

        foreach ($t as $key => $value)
        {
            $value->setPosition($key);
            $em->persist($value);
        }


        $em->flush();

        $auteurs = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findArrayAuteurs($publication, $this->get('router'));

        return new JsonResponse($auteurs, 200);

    }


}
