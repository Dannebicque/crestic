<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlateformesHasSliders
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlateformesHasSlidersRepository")
 */
class PlateformesHasSliders
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
     * @ORM\ManyToOne(targetEntity="Plateformes",inversedBy="sliders")
     */
    private $plateforme;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Slider",inversedBy="plateformes")
     */
    private $slider;

    public function __toString()
    {
        return $this->getPlateforme().' '.$this->getSlider();
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
     * Set plateforme
     *
     * @param Plateformes $plateforme
     *
     * @return PlateformesHasSliders
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

    /**
     * Set slider
     *
     * @param Slider $slider
     *
     * @return PlateformesHasSliders
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
