<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjetsHasSliders
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjetsHasSlidersRepository")
 */
class ProjetsHasSliders
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
     * @ORM\ManyToOne(targetEntity="Projets", inversedBy="sliders")
     * @ORM\JoinColumn(name="projets_id", referencedColumnName="id")
     */
    private $projet;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Slider", inversedBy="projets")
     */
    private $slider;


    public function __toString()
    {
        return $this->getProjet().' '.$this->getSlider();
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
     * @return ProjetsHasSliders
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
     * Set slider
     *
     * @param Slider $slider
     *
     * @return ProjetsHasSliders
     */
    public function setSlider(Slider $slider = null)
    {
        $this->slider = $slider;

        return $this;
    }

    /**
     * Get slider
     *
     * @return Slider
     */
    public function getSlider()
    {
        return $this->slider;
    }
}
