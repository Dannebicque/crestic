<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjetsHasFinanceurs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjetsHasFinanceursRepository")
 */
class ProjetsHasFinanceurs
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
     * @ORM\ManyToOne(targetEntity="Projets", inversedBy="financeurs")
     * @ORM\JoinColumn(name="projets_id", referencedColumnName="id")
     */
    private $projet;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Financeurs", inversedBy="projets")
     */
    private $financeur;

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
     * @return ProjetsHasFinanceurs
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
     * Set financeur
     *
     * @param Financeurs $financeur
     *
     * @return ProjetsHasFinanceurs
     */
    public function setFinanceur(Financeurs $financeur = null)
    {
        $this->financeur = $financeur;

        return $this;
    }

    /**
     * Get financeur
     *
     * @return Financeurs
     */
    public function getFinanceur()
    {
        return $this->financeur;
    }
}
