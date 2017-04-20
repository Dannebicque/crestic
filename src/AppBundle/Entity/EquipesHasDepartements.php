<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquipesHasDepartements
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipesHasDepartementsRepository")
 */
class EquipesHasDepartements
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Equipes", inversedBy="departements", fetch="EAGER")
     * @ORM\JoinColumn(name="equipe_id",referencedColumnName="id")
     */
    private $equipe;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Departements", inversedBy="equipes")
     * @ORM\JoinColumn(name="departement_id",referencedColumnName="id")
     */
    private $departement;

    public function __toString()
    {
        return $this->getEquipe().' '.$this->getDepartement();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set equipe
     *
     * @param Equipes $equipe
     *
     * @return EquipesHasDepartements
     */
    public function setEquipe(Equipes $equipe = null)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return Equipes
     */
    public function getEquipe()
    {
        return $this->equipe;
    }

    /**
     * Set departement
     *
     * @param Departements $departement
     *
     * @return EquipesHasDepartements
     */
    public function setDepartement(Departements $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return Departements
     */
    public function getDepartement()
    {
        return $this->departement;
    }
}
