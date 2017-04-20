<?php

namespace AppBundle\Repository;

/**
 * ProjetsHasSlidersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjetsHasSlidersRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllSliderFromProjetBuilder($id_projet)
    {
        return $this->createQueryBuilder('a','a.id')
            ->select ('a')
            ->innerJoin('a.slider', 'b')
            ->where('a.projet = ?1')
            ->setParameter(1,$id_projet)
            ->orderBy('b.url','ASC');
    }

    public function findAllSliderFromProjet ($id_projet)
    {
        return $this->findAllSliderFromProjetBuilder($id_projet)->getQuery()->getResult();
    }

    public function getArrayIdFromProjetsSlider ($id_projet)
    {
        $result = array();
        $array  =  $this->findAllSliderFromProjet($id_projet);

        foreach ($array as $key=>$value)
        {
            $id = $value->getSlider()->getId();
            $result[] = $id;
        }
        return $result;
    }
}