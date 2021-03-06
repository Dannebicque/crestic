<?php

namespace AppBundle\Repository;

/**
 * ActuEquipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActualitesAutresRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param int $nb
     * @return array
     */
    public function findLast($nb = 3)
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.created', 'desc')
            ->setMaxResults($nb)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $debut
     * @param $nb
     * @return array
     */
    public function findPagination($debut, $nb)
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.created', 'desc')
            ->setFirstResult($debut)
            ->setMaxResults($nb)
            ->getQuery()
            ->getResult();
    }
}
