<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Revues
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RevuesRepository")
 */
class Revues
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
     * @ORM\Column(name="titreRevue", type="string", length=255)
     */
    private $titreRevue;

    /**
     * @var string
     *
     * @ORM\Column(name="sigleRevue", type="string", length=100)
     */
    private $sigleRevue;

    /**
     * @var boolean
     *
     * @ORM\Column(name="internationale", type="boolean")
     */
    private $internationale = true;

    /**
     * @var float
     *
     * @ORM\Column(name="impactFactor", type="float", nullable=true)
     */
    private $impactFactor;

    /**
     * @var string
     *
     * @ORM\Column(name="classification", type="string", length=255, nullable=true)
     */
    private $classification;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Editeurs", inversedBy="revues")
     * @ORM\JoinColumn(name="editeur_id",referencedColumnName="id")
     */
    private $editeur;

    /**
     * @var \DateTime $created
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;


    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsRevues", mappedBy="revue")
     */
    private $publications;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->publications = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitreRevue();
    }

    /**
     * Get titreRevue
     *
     * @return string
     */
    public function getTitreRevue()
    {
        return $this->titreRevue;
    }

    /**
     * Set titreRevue
     *
     * @param string $titreRevue
     *
     * @return Revues
     */
    public function setTitreRevue($titreRevue)
    {
        $this->titreRevue = $titreRevue;

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
     * @return Revues
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get sigleRevue
     *
     * @return string
     */
    public function getSigleRevue()
    {
        return $this->sigleRevue;
    }

    /**
     * Set sigleRevue
     *
     * @param string $sigleRevue
     *
     * @return Revues
     */
    public function setSigleRevue($sigleRevue)
    {
        $this->sigleRevue = $sigleRevue;

        return $this;
    }

    /**
     * Get internationale
     *
     * @return boolean
     */
    public function getInternationale()
    {
        return $this->internationale;
    }

    /**
     * Set internationale
     *
     * @param boolean $internationale
     *
     * @return Revues
     */
    public function setInternationale($internationale)
    {
        $this->internationale = $internationale;

        return $this;
    }

    /**
     * Get impactFactor
     *
     * @return float
     */
    public function getImpactFactor()
    {
        return $this->impactFactor;
    }

    /**
     * Set impactFactor
     *
     * @param float $impactFactor
     *
     * @return Revues
     */
    public function setImpactFactor($impactFactor)
    {
        $this->impactFactor = $impactFactor;

        return $this;
    }

    /**
     * Get classification
     *
     * @return string
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * Set classification
     *
     * @param string $classification
     *
     * @return Revues
     */
    public function setClassification($classification)
    {
        $this->classification = $classification;

        return $this;
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
     * @return Revues
     */
    public function setEditeur(Editeurs $editeur = null)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Add publication
     *
     * @param PublicationsRevues $publication
     *
     * @return Revues
     */
    public function addPublication(PublicationsRevues $publication)
    {
        $this->publications[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param PublicationsRevues $publication
     */
    public function removePublication(PublicationsRevues $publication)
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

    public function display()
    {
        if ($this->sigleRevue !== '') {
            return $this->sigleRevue . ', ' . $this->titreRevue;
        }

        return $this->titreRevue;

    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Revues
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Revues
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Revues
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    public function getjson()
    {
        return array(
            'id'    => $this->id,
            'titre' => $this->titreRevue,
            'sigle' => $this->sigleRevue
        );
    }
}
