<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Departements
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepartementsRepository")
 */
class Departements
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="sigle", type="string", length=20, nullable=true)
     */
    private $sigle;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="text",nullable=true)
     */
    private $theme;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="MembresCrestic",inversedBy="departements")
     * @ORM\JoinColumn(name="membreCrestic_id",referencedColumnName="id")
     */
     private $membreCrestic;

    /**
     *
     * @ORM\OneToMany(targetEntity="EquipesHasDepartements", mappedBy="departement")
     */
    private $equipes;

    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsHasDepartements", mappedBy="departement")
     */
    private $publications;

    /**
     * @var string
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="MembresCrestic", mappedBy="departementMembre")
     */
    private $membres;

    public function __toString()
    {
        return $this->getNom();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Departements
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return Departements
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set membreCrestic
     *
     * @param MembresCrestic $membre
     *
     * @return Departements
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
     * Constructor
     */
    public function __construct()
    {
        $this->equipes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add equipe
     *
     * @param EquipesHasDepartements $equipe
     *
     * @return Departements
     */
    public function addEquipe(EquipesHasDepartements $equipe)
    {
        $this->equipes[] = $equipe;

        return $this;
    }

    /**
     * Remove equipe
     *
     * @param EquipesHasDepartements $equipe
     */
    public function removeEquipe(EquipesHasDepartements $equipe)
    {
        $this->equipes->removeElement($equipe);
    }

    /**
     * Get equipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipes()
    {
        return $this->equipes;
    }

    /**
     * Add membre
     *
     * @param MembresCrestic $membre
     *
     * @return Departements
     */
    public function addMembre(MembresCrestic $membre)
    {
        $this->membres[] = $membre;

        return $this;
    }

    /**
     * Remove membre
     *
     * @param MembresCrestic $membre
     */
    public function removeMembre(MembresCrestic $membre)
    {
        $this->membres->removeElement($membre);
    }

    /**
     * Get membres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembres()
    {
        return $this->membres;
    }

    /**
     * Add publication
     *
     * @param PublicationsHasDepartements $publication
     *
     * @return Departements
     */
    public function addPublication(PublicationsHasDepartements $publication)
    {
        $this->publications[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param PublicationsHasDepartements $publication
     */
    public function removePublication(PublicationsHasDepartements $publication)
    {
        $this->publications->removeElement($publication);
    }

    /**
     * Get publications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublications()
    {
        return $this->publications;
    }

    /**
     * Set sigle
     *
     * @param string $sigle
     *
     * @return Departements
     */
    public function setSigle($sigle)
    {
        $this->sigle = $sigle;

        return $this;
    }

    /**
     * Get sigle
     *
     * @return string
     */
    public function getSigle()
    {
        return $this->sigle;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Departements
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
