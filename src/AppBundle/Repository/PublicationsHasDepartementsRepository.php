<?php

namespace AppBundle\Repository;

use AppBundle\Entity\PublicationsHasDepartements;

/**
 * PublicationsHasDepartementsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PublicationsHasDepartementsRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllDepartementsFromPublicationBuilder($id_publication)
    {
        return $this->createQueryBuilder('a','a.id')
            ->select ('a')
            ->where('a.publication = ?1')
            ->setParameter(1,$id_publication);
    }

    public function findAllDepartementsFromPublication ($id_publication)
    {
        return $this->findAllDepartementsFromPublicationBuilder($id_publication)->getQuery()->getResult();
    }

    public function getArrayIdFromPublicationDepartement ($id_publication)
    {
        $result = array();
        $array  =  $this->findAllDepartementsFromPublication($id_publication);

        foreach ($array as $key=>$value)
        {
            if ($value->getDepartement() != null)
            {
                $id = $value->getDepartement()->getId();
                $result[] = $id;
            }
        }
        return $result;
    }

    public function findAllPublicationsFromDepartementBuilder($id_departement)
    {
        return $this->createQueryBuilder('a','a.id')
            ->select ('a')
            ->innerJoin('a.publication', 'b')
            ->where('a.departement')
            ->setParameter(1,$id_departement)
            ->orderBy('b.anneePublication','DESC');
    }

    public function findAllPublicationsFromDepartement ($id_departement)
    {
        return $this->findAllPublicationsFromDepartementBuilder($id_departement)->getQuery()->getResult();
    }

    public function findLastPublicationsFromDepartementBuilder($id_departement, $nb)
    {
        return $this->createQueryBuilder('a','a.id')
            ->select ('a')
            ->innerJoin('AppBundle:Publications', 'p', 'WITH', 'a.publication = p.id')
            ->where('a.departement')
            ->setParameter(1, $id_departement)
            ->orderBy('p.anneePublication, p.moisPublication', 'DESC')
            ->setMaxResults($nb);
    }

    public function findLastPublicationsFromDepartement ($id_departement, $nb)
    {
        return $this->findLastPublicationsFromDepartementBuilder($id_departement, $nb)->getQuery()->getResult();
    }

    public function getArrayIdFromDepartementPublications($idDepartement)
    {
        $result = array();
        $array  =  $this->findAllPublicationsFromDepartement($idDepartement);

        /** @var PublicationsHasDepartements $pub */
        foreach ($array as $pub)
        {
            if ($pub->getDepartement() !== null && $pub->getDepartement()->getId() == $idDepartement)
            {
                $result[$pub->getId()] = $pub->getPublication()->getAnneePublication();
            }
        }

        return $result;
    }
}
