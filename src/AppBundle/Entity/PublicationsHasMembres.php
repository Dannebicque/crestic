<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsHasMembres
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsHasMembresRepository")
 */
class PublicationsHasMembres
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
     * @var string
     *
     * @ORM\Column(name="position", type="integer")
     * @ORM\OrderBy({"sort_order" = "ASC"})
     */
     private $position;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Publications", inversedBy="membres", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="publication_id",referencedColumnName="id")
     */
     private $publication;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="MembresCrestic", inversedBy="publicationsHasMembres", fetch="EAGER")
     * @ORM\JoinColumn(name="membreCrestic_id", referencedColumnName="id")
     */
     private $membreCrestic;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MembresExterieurs", fetch="EAGER")
     * @ORM\JoinColumn(name="membreExterieur_id", referencedColumnName="id")
     */
    private $membreExterieur;

    public function __toString()
    {
        return $this->membreCrestic.' '.$this->membreExterieur;
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
     * Set position
     *
     * @param integer $position
     *
     * @return PublicationsHasMembres
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }


    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set publication
     *
     * @param Publications $publication
     *
     * @return PublicationsHasMembres
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
     * Set membreCrestic
     *
     * @param MembresCrestic $membreCrestic
     *
     * @return PublicationsHasMembres
     */
    public function setMembreCrestic(MembresCrestic $membreCrestic = null)
    {
        $this->membreCrestic = $membreCrestic;

        return $this;
    }

    /**
     * Get membreCrestic
     *
     * @return MembresCrestic
     */
    public function getMembreCrestic()
    {
        return $this->membreCrestic;
    }

    /**
     * Set membreExterieur
     *
     * @param MembresExterieurs $membreExterieur
     *
     * @return PublicationsHasMembres
     */
    public function setMembreExterieur(MembresExterieurs $membreExterieur = null)
    {
        $this->membreExterieur = $membreExterieur;

        return $this;
    }

    /**
     * Get membreExterieur
     *
     * @return MembresExterieurs
     */
    public function getMembreExterieur()
    {
        return $this->membreExterieur;
    }

//    public function getAuteurIEEE()
//    {
//        if ( ($this->getMembreCrestic() === null && $this->getMembreExterieur() === null) || ($this->getMembreCrestic() !== null && $this->getMembreExterieur() !== null))
//        {
//            return 'Err!';
//        } elseif ($this->membreCrestic !== null && $this->membreExterieur === null)
//        {
//            //membre crestic
//            return $this->getMembreCrestic()->getInitialePrenom().' '.$this->getMembreCrestic()->getNom();
//        } else
//        {
//            return $this->getMembreExterieur()->getInitialePrenom().' '.$this->getMembreExterieur()->getNom();
//        }
//    }
}
