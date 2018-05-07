<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Editeurs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EditeursRepository")
 */
class Editeurs
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
     * @ORM\Column(name="nom", type="string", length=255,nullable=true)
     */
    private $nom;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumn(name="pays_id",referencedColumnName="id")
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity="Revues", mappedBy="editeur")
     */
    private $revues;

    /**
     * @ORM\OneToMany(targetEntity="PublicationsOuvrages", mappedBy="editeur")
     */
    private $ouvrages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->revues = new ArrayCollection();
        $this->ouvrages = new ArrayCollection();
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
     * @param $id
     *
     * @return Editeurs
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Editeurs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Editeurs
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Editeurs
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * Add revue
     *
     * @param PublicationsRevues $revue
     *
     * @return Editeurs
     */
    public function addRevue(PublicationsRevues $revue)
    {
        $this->revues[] = $revue;

        return $this;
    }

    /**
     * Remove revue
     *
     * @param PublicationsRevues $revue
     */
    public function removeRevue(PublicationsRevues $revue)
    {
        $this->revues->removeElement($revue);
    }

    /**
     * Get revue
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRevues()
    {
        return $this->revues;
    }

    /**
     * Add ouvrage
     *
     * @param PublicationsOuvrages $ouvrage
     *
     * @return Editeurs
     */
    public function addOuvrage(PublicationsOuvrages $ouvrage)
    {
        $this->ouvrages[] = $ouvrage;

        return $this;
    }

    /**
     * Remove ouvrage
     *
     * @param PublicationsOuvrages $ouvrage
     */
    public function removeOuvrage(PublicationsOuvrages $ouvrage)
    {
        $this->ouvrages->removeElement($ouvrage);
    }

    /**
     * Get ouvrages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOuvrages()
    {
        return $this->ouvrages;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Editeurs
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }
}
