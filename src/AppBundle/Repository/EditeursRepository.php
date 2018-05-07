<?php

namespace AppBundle\Repository;

/**
 * EditeursRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EditeursRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */

    public function findAllEditeursBuilder()
    {
        return $this->createQueryBuilder('a','a.id')
            ->orderBy('a.nom', 'ASC');

    }

    /**
     * @return array
     */

    public function findAllEditeurs()
    {
        return $this->findAllEditeurBuilder()->getQuery()->getResult();
    }
}
