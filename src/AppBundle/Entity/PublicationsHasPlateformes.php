<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsHasPlateformes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsHasPlateformesRepository")
 */
class PublicationsHasPlateformes
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
     * @ORM\ManyToOne(targetEntity="Publications", inversedBy="plateformes")
     * @ORM\JoinColumn(name="publication_id",referencedColumnName="id")
     */
     private $publication;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Plateformes", inversedBy="publications")
     * @ORM\JoinColumn(name="plateforme_id", referencedColumnName="id")
     */

     private $plateforme;


     public function __toString()
     {
         return $this->getPublication().' '.$this->getPlateforme();
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
     * @return PublicationsHasPlateformes
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
     * Set plateforme
     *
     * @param Plateformes $plateforme
     *
     * @return PublicationsHasPlateformes
     */
    public function setPlateforme(Plateformes $plateforme = null)
    {
        $this->plateforme = $plateforme;

        return $this;
    }

    /**
     * Get plateforme
     *
     * @return Plateformes
     */
    public function getPlateforme()
    {
        return $this->plateforme;
    }
}
