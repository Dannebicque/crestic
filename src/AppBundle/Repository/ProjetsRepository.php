<?php

namespace AppBundle\Repository;

/**
 * ProjetsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjetsRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param null $array_options
     *
     * @return \Doctrine\ORM\QueryBuilder|null
     */

    public function findAllProjetsBuilder($array_options = null)
    {
        $result = null;

        switch ($array_options['role'])
        {
            case 'ROLE_ADMINISTRATEUR':
            {
                $result =  $this->createQueryBuilder('a','a.id')
                                ->orderBy('a.titre', 'ASC');
                break;
            }

            case 'ROLE_RESPONSABLE':
            {
                $result = $this->createQueryBuilder('a','a.id')
                               ->where  ('a.responsable = ?1')
                               ->orderBy('a.titre', 'ASC')
                               ->setParameter(1,$array_options['user_id']);
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
                                ->orderBy('a.titre', 'ASC');
                break;
            }
        }

        return $result;
    }

    public function findAllTermines()
    {
        return $this->createQueryBuilder('a','a.id')
                ->where('a.definestime < :datef')
                ->setParameter('datef', new \DateTime('now') )
                ->orderBy('a.titre', 'ASC')
                ->getQuery()
                ->getResult();
    }

    /**
     * @param null $array_options
     * @return array
     */

    public function findAllProjets($array_options = null)
    {
        return $this->findAllProjetsBuilder($array_options)->getQuery()->getResult();
    }
    
    public function findInternationaux()
    {
        return $this->createQueryBuilder('p')
                ->where('p.projetInternational = 1')
                ->andWhere('p.actif = 1')
                ->orderBy('p.titre', 'ASC')
                ->getQuery()
            ->getResult();
    }

    public function findAllProjetsResponsable($user)
    {
        return $this->createQueryBuilder('e')
            ->where('e.responsable = :user')
            ->setParameter('user', $user)
            ->orderBy('e.actif, e.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
