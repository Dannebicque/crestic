<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieProjet
 *
 * @ORM\Table(name="categorie_projet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieProjetRepository")
 */
class CategorieProjet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=100)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_en", type="string", length=100)
     */
    private $libelle_en;

    /**
     * @var Projets[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Projets", mappedBy="categorie")
     */
    private $projets;

    /** @var CategorieProjet
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CategorieProjet", mappedBy="parent")
     */
    private $enfants;

    /** @var CategorieProjet
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CategorieProjet", inversedBy="enfants")
     */
    private $parent;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return CategorieProjet
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\CategorieProjet $parent
     *
     * @return CategorieProjet
     */
    public function setParent(\AppBundle\Entity\CategorieProjet $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\CategorieProjet
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set libelleEn
     *
     * @param string $libelleEn
     *
     * @return CategorieProjet
     */
    public function setLibelleEn($libelleEn)
    {
        $this->libelle_en = $libelleEn;

        return $this;
    }

    /**
     * Get libelleEn
     *
     * @return string
     */
    public function getLibelleEn()
    {
        return $this->libelle_en;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add enfant
     *
     * @param \AppBundle\Entity\CategorieProjet $enfant
     *
     * @return CategorieProjet
     */
    public function addEnfant(\AppBundle\Entity\CategorieProjet $enfant)
    {
        $this->enfants[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \AppBundle\Entity\CategorieProjet $enfant
     */
    public function removeEnfant(\AppBundle\Entity\CategorieProjet $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Add projet
     *
     * @param \AppBundle\Entity\Projets $projet
     *
     * @return CategorieProjet
     */
    public function addProjet(\AppBundle\Entity\Projets $projet)
    {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param \AppBundle\Entity\Projets $projet
     */
    public function removeProjet(\AppBundle\Entity\Projets $projet)
    {
        $this->projets->removeElement($projet);
    }

    /**
     * Get projets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjets()
    {
        return $this->projets;
    }
}
