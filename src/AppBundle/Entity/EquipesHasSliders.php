<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquipesHasSliders
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipesHasSlidersRepository")
 */
class EquipesHasSliders
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
     * @ORM\ManyToOne(targetEntity="Equipes",inversedBy="sliders")
     * @ORM\JoinColumn(name="equipe_id", referencedColumnName="id")
     */
    private $equipe;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Slider",inversedBy="equipes")
     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id")
     */
    private $slider;

    public function __toString()
    {
        return $this->getEquipe().' '.$this->getSlider();
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
     * Set equipe
     *
     * @param Equipes $equipe
     *
     * @return EquipesHasSliders
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

    /**
     * Set slider
     *
     * @param Slider $slider
     *
     * @return EquipesHasSliders
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
