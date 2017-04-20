<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsHasEquipes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsHasEquipesRepository")
 */
class PublicationsHasEquipes
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
     * @ORM\ManyToOne(targetEntity="Publications", inversedBy="equipes")
     * @ORM\JoinColumn(name="publication_id",referencedColumnName="id")
     */
     private $publication;


    /**
     * 
     * @ORM\ManyToOne(targetEntity="Equipes", inversedBy="publications")
     * @ORM\JoinColumn(name="equipe_id",referencedColumnName="id")
     */
     private $equipe;


     public function __toString()
     {
         return $this->getPublication().' '.$this->getEquipe();
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
     * @return PublicationsHasEquipes
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
     * Set equipe
     *
     * @param Equipes $equipe
     *
     * @return PublicationsHasEquipes
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
}
