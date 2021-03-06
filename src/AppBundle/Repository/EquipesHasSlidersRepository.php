<?php

namespace AppBundle\Repository;

/**
 * EquipesHasSlidersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EquipesHasSlidersRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllSlidersFromEquipeBuilder($id_equipe)
    {
        return $this->createQueryBuilder('a','a.id')
            ->select ('a')
            ->where('a.equipe = ?1')
            ->innerJoin('a.slider','b')
            //->orderBy('b.nom','asc')
            ->setParameter(1,$id_equipe);
    }

    public function findAllSlidersFromEquipe ($id_equipe)
    {
        $result = $this->findAllSlidersFromEquipeBuilder($id_equipe)->getQuery()->getResult();

        return $result;
    }

    public function getArrayIdFromEquipeSlider ($id_equipe)
    {
        $result = array();
        $array  =  $this->findAllSlidersFromEquipe($id_equipe);

        foreach ($array as $key=>$value)
        {
            $id = $value->getSlider()->getId();
            $result[] = $id;
        }
        return $result;
    }
}
