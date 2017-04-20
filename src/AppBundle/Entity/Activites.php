<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activites
 *
 * @ORM\Table(name="activites")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActivitesRepository")
 */
class Activites
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
     * @ORM\Column(name="titre", type="string", length=150)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var \DateTime $created
     * @ORM\Column(type="datetime")
     */
    protected $created;
    /**
     * @var \DateTime $updated
     * @ORM\Column(type="datetime")
     */
    protected $updated;
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MembresCrestic", inversedBy="activites", fetch="EAGER")
     */
    protected $membreCrestic;

    public function __construct(MembresCrestic $user)
    {
        $this->membreCrestic = $user;
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updated = new \DateTime();
    }

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Activites
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

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
     * Set texte
     *
     * @param string $texte
     *
     * @return Activites
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Activites
     */
    public function setCreated($created)
    {
        $this->created = $created;

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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Activites
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

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
     * Set membreCrestic
     *
     * @param \AppBundle\Entity\MembresCrestic $membreCrestic
     *
     * @return Activites
     */
    public function setMembreCrestic(\AppBundle\Entity\MembresCrestic $membreCrestic = null)
    {
        $this->membreCrestic = $membreCrestic;

        return $this;
    }

    /**
     * Get membreCrestic
     *
     * @return \AppBundle\Entity\MembresCrestic
     */
    public function getMembreCrestic()
    {
        return $this->membreCrestic;
    }
}
