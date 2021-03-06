<?php

namespace AppBundle\Repository;

/**
 * ConfigurationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConfigurationRepository extends \Doctrine\ORM\EntityRepository
{
    public function findArray()
    {
        $elts = $this->findAll();
        $array = array();

        foreach ($elts as $value)
        {
            $array[$value->getCle()] = $value->getValue();
        }

        return $array;
    }
}
