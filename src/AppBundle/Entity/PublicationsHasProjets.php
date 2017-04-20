<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsHasProjets
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsHasProjetsRepository")
 */
class PublicationsHasProjets
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
     * @ORM\ManyToOne(targetEntity="Publications", inversedBy="projets")
     * @ORM\JoinColumn(name="publication_id",referencedColumnName="id")
     */
     private $publication;


    /**
     * 
     * @ORM\ManyToOne(targetEntity="Projets", inversedBy="publications")
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     */
     private $projet;


     public function __toString()
     {
         return $this->getPublication().' '.$this->getProjet();
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
     * @return PublicationsHasProjets
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
     * Set projet
     *
     * @param Projets $projet
     *
     * @return PublicationsHasProjets
     */
    public function setProjet(Projets $projet = null)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return Projets
     */
    public function getProjet()
    {
        return $this->projet;
    }
}
