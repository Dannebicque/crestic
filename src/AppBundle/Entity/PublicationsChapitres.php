<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsChapitres
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsChapitresRepository")
 */
class PublicationsChapitres  extends Publications
{
    protected $type = 'chapitre';
    protected $couleur = "#FA7100";

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
     * @ORM\Column(name="titreOuvrage", type="string", length=255,nullable=true)
     */
    private $titreOuvrage;

    /**
     * @var string
     *
     * @ORM\Column(name="typeOuvrage", type="string", length=255, nullable=true)
     */
    private $typeOuvrage;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=255, nullable=true)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=20, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=20, nullable=true)
     */
    private $isbn;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Editeurs", inversedBy="ouvrages")
     * @ORM\JoinColumn(name="editeur_id",referencedColumnName="id")
     */
    private $editeur;

    /**
     * @var string
     *
     * @ORM\Column(name="redacteurChef", type="string", length=255, nullable=true)
     */
    private $redacteurChef='';

    /**
     * @var boolean
     *
     * @ORM\Column(name="vulgarisation", type="boolean")
     */
    private $vulgarisation = false;

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
     * Set titreOuvrage
     *
     * @param string $titreOuvrage
     *
     * @return PublicationsChapitres
     */
    public function setTitreOuvrage($titreOuvrage)
    {
        $this->titreOuvrage = $titreOuvrage;

        return $this;
    }

    /**
     * Get titreOuvrage
     *
     * @return string
     */
    public function getTitreOuvrage()
    {
        return $this->titreOuvrage;
    }

    /**
     * Set typeOuvrage
     *
     * @param string $typeOuvrage
     *
     * @return PublicationsChapitres
     */
    public function setTypeOuvrage($typeOuvrage)
    {
        $this->typeOuvrage = $typeOuvrage;

        return $this;
    }

    /**
     * Get typeOuvrage
     *
     * @return string
     */
    public function getTypeOuvrage()
    {
        return $this->typeOuvrage;
    }

    /**
     * Set serie
     *
     * @param string $serie
     *
     * @return PublicationsChapitres
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return PublicationsChapitres
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
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
     * @return PublicationsChapitres
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
     * Set numero
     *
     * @param string $numero
     *
     * @return PublicationsChapitres
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
}
