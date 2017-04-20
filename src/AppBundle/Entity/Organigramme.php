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
     * @var boolean
     *
     * @ORM\Column(name="responsabiliteFonction", type="text",nullable=true)
     */
    private $responsabiliteFonction;


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
     * Set id
     *
     * @return integer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
}
