<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sites
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SitesRepository")
 */
class Sites
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
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=20, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="map", type="text")
     */
    private $map;

    /**
     * @var boolean
     *
     * @ORM\Column(name="principale", type="boolean")
     */
    private $principale = false;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MembresCrestic")
     * @ORM\JoinColumn(name="membre_id",referencedColumnName="id")
     */
    private $membreCrestic;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Cms")
     */
    private $cms;


    public function __toString()
    {
        return "" . $this->getMembreCrestic();
    }

    /**
     * Get membre
     *
     * @return MembresCrestic
     */
    public function getMembreCrestic()
    {
        return $this->membreCrestic;
    }

    /**
     * Set membre
     *
     * @param MembresCrestic|null $membreCrestic
     *
     * @return Sites
     */
    public function setMembreCrestic(MembresCrestic $membreCrestic = null)
    {
        $this->membreCrestic = $membreCrestic;

        return $this;
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
     * @return Sites
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Sites
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Sites
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
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
     * @return Sites
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Sites
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Sites
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Sites
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get map
     *
     * @return string
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set map
     *
     * @param string $map
     *
     * @return Sites
     */
    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * Get principale
     *
     * @return boolean
     */
    public function getPrincipale()
    {
        return $this->principale;
    }

    /**
     * Set principale
     *
     * @param boolean $principale
     *
     * @return Sites
     */
    public function setPrincipale($principale)
    {
        $this->principale = $principale;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Sites
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get cms
     *
     * @return Cms
     */
    public function getCms()
    {
        return $this->cms;
    }

    /**
     * Set cms
     *
     * @param Cms $cms
     *
     * @return Sites
     */
    public function setCms(Cms $cms = null)
    {
        $this->cms = $cms;

        return $this;
    }
}
