<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsRevues
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsRevuesRepository")
 */
class PublicationsRevues  extends Publications
{
    protected $type = 'revue';
    protected $couleur = "#c32b72";

    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="volume", type="string", length=30, nullable=true)
     */
    private $volume='';

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=30, nullable=true)
     */
    private $numero;

    /**
     * @var boolean
     *
     * @ORM\Column(name="comiteLecture", type="boolean")
     */
    private $comiteLecture = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vulgarisation", type="boolean")
     */
    private $vulgarisation = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="editorial", type="boolean")
     */
    private $editorial = false;

    /**
     * @var string
     *
     * @ORM\Column(name="issn", type="string", length=20, nullable=true)
     */
    private $issn;

    /**
     * @var string
     *
     * @ORM\Column(name="specialIssue", type="string", length=255, nullable=true)
     */
    private $specialIssue;

    /**
     * @var string
     *
     * @ORM\Column(name="redacteurChef", type="string", length=255, nullable=true)
     */
    private $redacteurChef='';

    /**
     *
     * @ORM\ManyToOne(targetEntity="Revues", inversedBy="publications")
     */
    private $revue;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Editeurs")
     * @ORM\JoinColumn(name="editeur_id",referencedColumnName="id")
     */
    private $editeur;

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
     * Set volume
     *
     * @param integer $volume
     *
     * @return PublicationsRevues
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return integer
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set comiteLecture
     *
     * @param boolean $comiteLecture
     *
     * @return PublicationsRevues
     */
    public function setComiteLecture($comiteLecture)
    {
        $this->comiteLecture = $comiteLecture;

        return $this;
    }

    /**
     * Get comiteLecture
     *
     * @return boolean
     */
    public function getComiteLecture()
    {
        return $this->comiteLecture;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return PublicationsRevues
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set issn
     *
     * @param string $issn
     *
     * @return PublicationsRevues
     */
    public function setIssn($issn)
    {
        $this->issn = $issn;

        return $this;
    }

    /**
     * Get issn
     *
     * @return string
     */
    public function getIssn()
    {
        return $this->issn;
    }

    /**
     * Get redacteurChef
     *
     * @return string
     */
    public function getRedacteurChef()
    {
        return $this->redacteurChef;
    }

    /**
     * Set redacteurChef
     *
     * @param string $redacteurChef
     *
     * @return Publications
     */
    public function setRedacteurChef($redacteurChef)
    {
        $this->redacteurChef = $redacteurChef;

        return $this;
    }

    /**
     * Set vulgarisation
     *
     * @param boolean $vulgarisation
     *
     * @return PublicationsRevues
     */
    public function setVulgarisation($vulgarisation)
    {
        $this->vulgarisation = $vulgarisation;

        return $this;
    }

    /**
     * Get vulgarisation
     *
     * @return boolean
     */
    public function getVulgarisation()
    {
        return $this->vulgarisation;
    }

    /**
     * Set editorial
     *
     * @param boolean $editorial
     *
     * @return PublicationsRevues
     */
    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;

        return $this;
    }

    /**
     * Get editorial
     *
     * @return boolean
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Set specialIssue
     *
     * @param string $specialIssue
     *
     * @return PublicationsRevues
     */
    public function setSpecialIssue($specialIssue)
    {
        $this->specialIssue = $specialIssue;

        return $this;
    }

    /**
     * Get specialIssue
     *
     * @return string
     */
    public function getSpecialIssue()
    {
        return $this->specialIssue;
    }

    /**
     * Set revue
     *
     * @param Revues $revue
     *
     * @return PublicationsRevues
     */
    public function setRevue(Revues $revue = null)
    {
        $this->revue = $revue;

        return $this;
    }

    /**
     * Get revue
     *
     * @return Revues
     */
    public function getRevue()
    {
        return $this->revue;
    }

    /**
     * Get editeur
     *
     * @return Editeurs
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set editeur
     *
     * @param Editeurs $editeur
     *
     * @return Publications
     */
    public function setEditeur(Editeurs $editeur = null)
    {
        $this->editeur = $editeur;

        return $this;
    }
}
