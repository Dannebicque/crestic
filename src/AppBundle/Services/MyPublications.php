<?php
/**
 * Created by PhpStorm.
 * User: D.ANNEBICQUE
 * Date: 31/05/2017
 * Time: 10:30
 */

namespace AppBundle\Services;


use Doctrine\ORM\EntityManager;

class MyPublications
{

    /** @var EntityManager */
    protected $entityManager;

    public function __construct($_entityManager)
    {
        $this->entityManager = $_entityManager;
    }

    public function search($criteres)
    {
        //on recherche selon l'ensemble des critères un tableau d'ID de publication.
        //Ensuite on fusionnera le tableau résultat

        if ($criteres['typePublication'] != '')
        {
            //on récupère les ID des publications
            $publications = $this->entityManager->getRepository('Publications' . $criteres['typePublication'])->search($criteres);
        } else
        {
            $publications = $this->entityManager->getRepository('Publications')->findSearchPublicationsBuilder($criteres);
        }

        if ($criteres['auteur'] != '')
        {
            // récupère les ID des publications de l'auteur recherché
            $publicationAuteur = $this->entityManager->getRepository('AppBundle:PublicationsHasMembres')->getArrayIdFromAuteurPublications($criteres['auteur']);
        } else
        {
            $publicationAuteur = null;
        }

        if ($criteres['projet'] != '')
        {
            // récupère les ID des publications du projet recherché
            $publicationProjet = $this->entityManager->getRepository('AppBundle:PublicationsHasProjets')->getArrayIdFromProjetPublications($criteres['projet']);
        } else
        {
            $publicationProjet = null;
        }

        if ($criteres['equipe'] != '')
        {
            // récupère les ID des publications de l'equipe recherché
            $publicationEquipe = $this->entityManager->getRepository('AppBundle:PublicationsHasEquipes')->getArrayIdFromEquipePublications($criteres['equipe']);
        } else
        {
            $publicationEquipe = null;
        }

        if ($criteres['departement'] != '')
        {
            // récupère les ID des publications du département recherché
            $publicationDepartement = $this->entityManager->getRepository('AppBundle:PublicationsHasDepartements')->getArrayIdFromDepartementPublications($criteres['departement']);
        } else
        {
            $publicationDepartement = null;
        }

        //fusion des tableaux
    }
}