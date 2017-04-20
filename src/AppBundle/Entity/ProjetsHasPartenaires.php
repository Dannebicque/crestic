<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjetsHasPartenaires
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjetsHasPartenairesRepository")
 */
class ProjetsHasPartenaires
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
     * @ORM\ManyToOne(targetEntity="Projets", inversedBy="partenaires")
     * @ORM\JoinColumn(name="projets_id", referencedColumnName="id")
     */
    private $projet;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Partenaires", inversedBy="projets")
     */
    private $partenaire;

    /**
     * @var boolean
     *
     * @ORM\Column(name="financeur", type="boolean",nullable=true)
     */
    private $financeur = False;

    public function __toString()
    {
        return $this->getProjet().' '.$this->getPartenaire();
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
     * Set projet
     *
     * @param Projets $projet
     *
     * @return ProjetsHasPartenaires
     */
    public function setProjet(Projets $projet = null)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return Projets
     */
    public function getProjet()
    {
        return $this->projet;
    }
    
    /**
     * Set partenaire
     *
     * @param Partenaires $partenaire
     *
     * @return ProjetsHasPartenaires
     */
    public function setPartenaire(Partenaires $partenaire = null)
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * Get partenaire
     *
     * @return Partenaires
     */
    public function getPartenaire()
    {
        return $this->partenaire;
    }

    /**
     * Get financeur
     *
     * @return boolean
     */
    public function getFinanceur()
    {
        return $this->financeur;
    }

    /**
     * Set financeur
     *
     * @param boolean $financeur
     *
     * @return ProjetsHasPartenaires
     */
    public function setFinanceur($financeur)
    {
        $this->financeur = $financeur;

        return $this;
    }
}
