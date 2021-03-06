<?php

namespace AppBundle\Repository;

use AppBundle\Entity\PublicationsHasProjets;

/**
 * PublicationsHasProjetsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PublicationsHasProjetsRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllPublicationsFromProjetBuilder($id_projet)
    {
        return $this->createQueryBuilder('a','a.id')
            ->select ('a')
            ->where('a.projet = ?1')
            ->setParameter(1,$id_projet);
    }

    public function findAllPublicationsFromProjet ($id_projet)
    {
        return $this->findAllPublicationsFromProjetBuilder($id_projet)->getQuery()->getResult();
    }

    public function findAllProjetsFromPublication ($idpublication)
    {
        return $this->createQueryBuilder('a','a.id')
            ->select ('a')
            ->where('a.publication = ?1')
            ->setParameter(1,$idpublication)
            ->getQuery()->getResult();
    }

    public function getArrayIdFromPublicationProjets ($id_projet)
    {
        $result = array();
        $array  =  $this->findAllPublicationsFromProjet($id_projet);

        foreach ($array as $key=>$value)
        {
            $id = $value->getProjet()->getId();
            $result[] = $id;
        }
        return $result;
    }

    public function findLastPublicationsFromProjetBuilder($id_projet, $nb)
    {
        return $this->createQueryBuilder('a','a.id')
            ->select ('a')
            ->innerJoin('AppBundle:Publications', 'p', 'WITH', 'a.publication = p.id')
            ->where('a.projet = ?1')
            ->setParameter(1, $id_projet)
            ->orderBy('p.anneePublication', 'DESC')
            ->orderBy('p.moisPublication', 'DESC')
            ->setMaxResults($nb);
    }

    public function findLastPublicationsFromProjet ($id_projet, $nb)
    {
        return $this->findLastPublicationsFromProjetBuilder($id_projet, $nb)->getQuery()->getResult();
    }

    public function findAllIdProjets($idpublication)
    {
        $projets = $this->findAllProjetsFromPublication($idpublication);
        $t =array();
        /** @var PublicationsHasProjets $e */
        foreach ($projets as $e)
        {
            $t[$e->getProjet()->getId()] = $e;
        }

        return $t;
    }

    public function getArrayIdFromProjetPublications($idProjet)
    {
        $result = array();
        $array  =  $this->findAllPublicationsFromProjet($idProjet);

        /** @var PublicationsHasProjets $pub */
        foreach ($array as $pub)
        {
            if ($pub->getProjet() !== null && $pub->getProjet()->getId() == $idProjet)
            {
                $result[$pub->getId()] = $pub->getPublication()->getAnneePublication();
            }
        }

        return $result;
    }

    public function updatePubli($old, $new)
    {
        $qb = $this->createQueryBuilder('u');
        $q = $qb->update( )
            ->set('u.publication', $new)
            ->where('u.publication = ?1')
            ->setParameter(1, $old)
            ->getQuery();
        $q->execute();
    }
}
