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
 * Demandeom controller.
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

        $pubRevues = $this->getDoctrine()->getRepository('AppBundle:PublicationsRevues')->findByAuteurCrestic($user->getId());
        $pubBrevets = $this->getDoctrine()->getRepository('AppBundle:PublicationsBrevets')->findByAuteurCrestic($user->getId());
        $pubChapitres = $this->getDoctrine()->getRepository('AppBundle:PublicationsChapitres')->findByAuteurCrestic($user->getId());
        $pubConferences = $this->getDoctrine()->getRepository('AppBundle:PublicationsConferences')->findByAuteurCrestic($user->getId());
        $pubRapports = $this->getDoctrine()->getRepository('AppBundle:PublicationsRapports')->findByAuteurCrestic($user->getId());
        $pubTheses = $this->getDoctrine()->getRepository('AppBundle:PublicationsTheses')->findByAuteurCrestic($user->getId());
        $pubOuvrages = $this->getDoctrine()->getRepository('AppBundle:PublicationsOuvrages')->findByAuteurCrestic($user->getId());


        return $this->render('@App/Utilisateur/publications/index.html.twig', array(
            'pubRevues'        => $pubRevues,
            'pubBrevets'       => $pubBrevets,
            'pubChapitres'     => $pubChapitres,
            'pubConferences'   => $pubConferences,
            'pubRapports'      => $pubRapports,
            'pubTheses'        => $pubTheses,
            'pubOuvrages'      => $pubOuvrages,
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
                $form = $this->createForm('AppBundle\Form\PublicationsRevuesType', $publication);
                break;
            case 'conference':
                $publication = new PublicationsConferences();
                $form = $this->createForm('AppBundle\Form\PublicationsConferencesType', $publication);
                break;
            case 'rapport':
                $publication = new PublicationsRapports();
                $form = $this->createForm('AppBundle\Form\PublicationsRapportsType', $publication);
                break;
            case 'these':
                $publication = new PublicationsTheses();
                $form = $this->createForm('AppBundle\Form\PublicationsThesesType', $publication);
                break;
            case 'brevet':
                $publication = new PublicationsBrevets();
                $form = $this->createForm('AppBundle\Form\PublicationsBrevetsType', $publication);
                break;
            case 'ouvrage':
                $publication = new PublicationsOuvrages();
                $form = $this->createForm('AppBundle\Form\PublicationsOuvragesType', $publication);
                break;
            case 'chapitre':
                $publication = new PublicationsChapitres();
                $form = $this->createForm('AppBundle\Form\PublicationsChapitresType', $publication);
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
            'type'=> $type
        ));
    }

    /**
     * @param Request      $request
     * @param Publications $id
     * @route("/options/{id}", name="utilisateur_publications_etape2")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function optionsPublicationsAction(Request $request, Publications $id)
    {
        $projets = $this->getDoctrine()->getRepository('AppBundle:Projets')->findAll();
        $plateformes = $this->getDoctrine()->getRepository('AppBundle:Plateformes')->findAll();
        $equipes = $this->getDoctrine()->getRepository('AppBundle:Equipes')->findAllEquipesActives();
        $auteurs = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findArrayAuteurs($id->getId());
        $publiHasEquipes = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasEquipes')->findAllIdEquipes($id->getId());
        $publiHasProjets = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasProjets')->findAllIdProjets($id->getId());
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
        $lettres = $request->request->get('lettres');
        $auteurs = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->findByLettre($lettres);
        //$auteursExt = $this->getDoctrine()->getRepository('AppBundle:MembresExterieurs')->search($lettre);

        $tjson = array();
        /** @var MembresCrestic $auteur */
        foreach ($auteurs as $auteur)
        {
            $t['id'] = $auteur->getId();
            $t['nom'] = $auteur->getNom();
            $t['prenom'] = $auteur->getPrenom();
            $t['status'] = $auteur->getStatus();
            $tjson[] = $t;
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
        $idauteur = $request->request->get('auteur');
        $idpublication = $request->request->get('publication');

        $auteur = $this->getDoctrine()->getRepository('AppBundle:MembresCrestic')->find($idauteur);
        //$auteursExt = $this->getDoctrine()->getRepository('AppBundle:MembresExterieurs')->search($lettre);
        $publication = $this->getDoctrine()->getRepository('AppBundle:Publications')->find($idpublication);

        if ($auteur && $publication)
        {
            $maxAuteur = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findBy(array('publication' => $idpublication));

            $em = $this->getDoctrine()->getManager();
            $pm = new PublicationsHasMembres();
            $pm->setMembreCrestic($auteur);
            $pm->setPublication($publication);
            $pm->setPosition(count($maxAuteur)+1);
            $em->persist($pm);
            $em->flush();

            $auteurs = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasMembres')->findArrayAuteurs($idpublication);

            return new JsonResponse($$auteurs, 200);
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
        $type = $request->request->get('type');
        $id = $request->request->get('id');
        $valeur = $request->request->get('valeur');
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
    public function ajxSupprAuteurAction(Request $request)
    {
        $type = $request->request->get('type');
        $id = $request->request->get('id');
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
}
