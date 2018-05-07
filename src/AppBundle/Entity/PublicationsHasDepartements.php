<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsHasEquipes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsHasDepartementsRepository")
 */
class PublicationsHasDepartements
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
     * @ORM\ManyToOne(targetEntity="Publications", inversedBy="departements")
     * @ORM\JoinColumn(name="publication_id",referencedColumnName="id")
     */
     private $publication;


    /**
     * 
     * @ORM\ManyToOne(targetEntity="Departements", inversedBy="publications")
     * @ORM\JoinColumn(name="equipe_id",referencedColumnName="id")
     */
     private $departement;


     public function __toString()
     {
         return $this->getPublication().' '.$this->getDepartement();
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
     * Set publication
     *
     * @param Publications $publication
     *
     * @return PublicationsHasDepartements
     */
    public function setPublication(Publications $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return Publications
     */
    public function getPublication()
    {
        return $this->publication;
    }


    /**
     * Set departement
     *
     * @param Departements $departement
     *
     * @return PublicationsHasDepartements
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
