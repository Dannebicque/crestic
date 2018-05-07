<?php

namespace AppBundle\Repository;

/**
 * DepartementsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DepartementsRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param null $array_options
     *
     * @return \Doctrine\ORM\QueryBuilder|null
     */

    public function findAllDepartementsBuilder($array_options = null)
    {
        $result = null;

        switch ($array_options['role'])
        {
            case 'ROLE_ADMINISTRATEUR':
            {
                $result =  $this->createQueryBuilder('a','a.id')
                                ->orderBy('a.nom', 'ASC');
                break;
            }

            case 'ROLE_RESPONSABLE':
            {
                break;
            }

            case 'ROLE_MEMBRE':
            {
                break;
            }

            case 'ROLE_VISITEUR':
            {
                break;
            }

            default :
            {
                $result =  $this->createQueryBuilder('a','a.id')
                                ->orderBy('a.nom', 'ASC');
                break;
            }
        }

        return $result;
    }


    /**
     * @param null $array_options
     * @return array
     */

    public function findAllDepartements($array_options = null)
    {
        return $this->findAllDepartementsBuilder($array_options)->getQuery()->getResult();
    }


}
