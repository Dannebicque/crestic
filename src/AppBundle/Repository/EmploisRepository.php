<?php

namespace AppBundle\Repository;

/**
 * EmploisRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EmploisRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('updated' => 'desc'));
    }
}