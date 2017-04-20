<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjetsHasMembres
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjetsHasMembresRepository")
 */
class ProjetsHasMembres
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
     * @ORM\ManyToOne(targetEntity="MembresCrestic", inversedBy="projets")
     * @ORM\JoinColumn(name="membreCrestic_id", referencedColumnName="id")
     */
    private $membreCrestic;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Projets", inversedBy="membres")
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     */
    private $projet;

    public function __toString()
    {
        return $this->getProjet().' '.$this->getMembreCrestic();
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
     * Set membreCrestic
     *
     * @param MembresCrestic $membreCrestic
     *
     * @return ProjetsHasMembres
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
     * Set projet
     *
     * @param Projets $projet
     *
     * @return ProjetsHasMembres
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
