<?php

namespace AppBundle\Controller\Visiteur;

use AppBundle\Entity\Publications;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PublicPublicationsController
 * @package AppBundle\Controller
 * @Route("/publications")
 */
class PublicPublicationsController extends Controller
{
    /**
     * @Route("/", name="public_publications")
     */
    public function indexAction()
    {
        $equipes           = $this->getDoctrine()->getManager()->getRepository('AppBundle:Equipes')->findAllEquipesActives();
        $projets           = $this->getDoctrine()->getManager()->getRepository('AppBundle:Projets')->findAll();
        $departements      = $this->getDoctrine()->getManager()->getRepository('AppBundle:Departements')->findAll();
        $countpublications = $this->getDoctrine()->getRepository('AppBundle:Publications')->count();


        return $this->render('AppBundle:PublicPublications:index.html.twig', array(
            'equipes'      => $equipes,
            'projets'      => $projets,
            'departements' => $departements,
            'nbpublis'     => $countpublications,
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
     * @Route("/show/{id}/{type}", name="public_publication_show")
     */
    public function showAction($id, $type)
    {
        $publication         = $this->getPublicationFromType($id, $type);
        $publiHasEquipes     = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasEquipes')->findAllPublicationsFromEquipe($publication->getId());
        $publiHasProjets     = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasProjets')->findAllPublicationsFromProjet($publication->getId());
        $publiHasPlateformes = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasPlateformes')->findAllPlateformesFromPublication($publication->getId());

        return $this->render('@App/PublicPublications/show.html.twig', array(
            'publication' => $publication,
            'equipes'     => $publiHasEquipes,
            'projets'     => $publiHasProjets,
            'plateformes' => $publiHasPlateformes,
        ));
    }

    /**
     * @param Request $request
     * @Route("/search", name="public_publications_search", methods={"POST"})
     */
    public function searchAction(Request $request)
    {
        $criteres['equipe']          = $request->request->get('equipe');
        $criteres['projet']          = $request->request->get('projet');
        $criteres['departement']     = $request->request->get('departement');
        $criteres['typePublication'] = $request->request->get('typePublication');
        $criteres['auteur']          = $request->request->get('auteur');
        $criteres['keywords']        = $request->request->get('keywords');
        $criteres['dateDebut']       = $request->request->get('dateDebut');
        $criteres['dateFin']         = $request->request->get('dateFin');

        $publications = $this->getDoctrine()->getRepository('AppBundle:Publications')->findSearchPublications($criteres['typePublication'], $criteres);

        $t  = array();
        $anneeFin = (int)date('Y')+1;
        for ($i = 2004; $i <= $anneeFin; $i++)
        {
            $t[$i] = array();
        }
        $t[0] = array();

        /** @var Publications $p */
        foreach ($publications as $p)
        {
            $t[$p->getAnneePublication()][] = $p;
        }

        return $this->render('@App/PublicPublications/resultat_recherche.html.twig', array(
            'publications' => $t,
            'nbresult'     => count($publications),
            'criteres'     => 'criteres',
            'anneefin'=>$anneeFin
        ));
    }

    /**
     * @param Request $request
     * @Route("ajax/bibtex", name="public_publication_ajax_bibtex")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bibTexAction(Request $request)
    {
        $idPublication = $request->request->get('publication');
        $publication   = $this->getDoctrine()->getRepository('AppBundle:Publications')->find($idPublication);

        if ($publication)
        {
            return $this->render('@App/PublicPublications/bibtex.html.twig', array(
                'publication' => $publication
            ));
        } else
        {
            return $this->render('@App/PublicPublications/bibtex.html.twig', array(
                'publication' => null
            ));
        }
    }
}
