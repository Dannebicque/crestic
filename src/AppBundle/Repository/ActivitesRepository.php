<?php

namespace AppBundle\Repository;

/**
 * ActivitesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActivitesRepository extends \Doctrine\ORM\EntityRepository
{
    public function findActivitesMembre($user)
    {
        return $this->findBy(array('membreCrestic' => $user), array('created' => 'DESC'));
    }

    public function findLastActiviteMembre($user, $nb = 3)
    {
        return $this->createQueryBuilder('a')
            ->where('a.membreCrestic = :user')
            ->setParameter('user', $user)
            ->orderBy('a.created', 'DESC')
            ->setMaxResults($nb)
            ->getQuery()
            ->getResult();
    }
}
