<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjetsHasPlateformes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjetsHasPlateformesRepository")
 */
class ProjetsHasPlateformes
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
     * @ORM\ManyToOne(targetEntity="Projets", inversedBy="plateformes")
     * @ORM\JoinColumn(name="projets_id", referencedColumnName="id")
     */
    private $projet;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Plateformes", inversedBy="projets")
     */
    private $plateforme;


    public function __toString()
    {
        return $this->getProjet().' '.$this->getPlateforme();
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
     * Set projet
     *
     * @param Projets $projet
     *
     * @return ProjetsHasPlateformes
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

    /**
     * Set plateforme
     *
     * @param Plateformes $plateforme
     *
     * @return ProjetsHasPlateformes
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
