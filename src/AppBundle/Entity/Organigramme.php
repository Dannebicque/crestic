<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organigramme
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganigrammeRepository")
 */
class Organigramme
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
     * @ORM\ManyToOne(targetEntity="MembresCrestic",cascade={"persist"})
     * @ORM\JoinColumn(name="membreCrestic_id",referencedColumnName="id")
     */
    private $membreCrestic;

    /**
     * @var string
     *
     * @ORM\Column(name="responsabiliteFonction", type="text",nullable=true)
     */
    private $responsabiliteFonction;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre = 1;


    public function __toString()
    {
        return $this->membreCrestic.' '.$this->responsabiliteFonction;
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
     * Set responsabiliteFonction
     *
     * @param boolean $responsabiliteFonction
     *
     * @return Organigramme
     */
    public function setResponsabiliteFonction($responsabiliteFonction)
    {
        $this->responsabiliteFonction = $responsabiliteFonction;

        return $this;
    }

    /**
     * Get responsabiliteFonction
     *
     * @return boolean
     */
    public function getResponsabiliteFonction()
    {
        return $this->responsabiliteFonction;
    }


    /**
     * Set membreCrestic
     *
     * @param MembresCrestic $membreCrestic
     *
     * @return Organigramme
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
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Organigramme
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
}
