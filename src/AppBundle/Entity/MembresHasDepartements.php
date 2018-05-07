<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MembresHasDepartements
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MembresHasDepartementsRepository")
 */
class MembresHasDepartements
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MembresCrestic", inversedBy="departements", fetch="EAGER")
     */
    private $membre;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Departements", inversedBy="equipes")
     * @ORM\JoinColumn(name="departement_id",referencedColumnName="id")
     */
    private $departement;

    public function __toString()
    {
        return $this->getMembre().' '.$this->getDepartement();
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
     * @return mixed
     */
    public function getMembre()
    {
        return $this->membre;
    }

    /**
     * @param mixed $membre
     */
    public function setMembre($membre)
    {
        $this->membre = $membre;
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
