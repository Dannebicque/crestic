<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmploisHasProjets
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmploisHasProjetsRepository")
 */
class EmploisHasProjets
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
     * @ORM\ManyToOne(targetEntity="Emplois")
     */
    private $emploi;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Projets")
     */
    private $projet;

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
     * Set emploi
     *
     * @param Emplois $emploi
     *
     * @return EmploisHasProjets
     */
    public function setEmploi(Emplois $emploi = null)
    {
        $this->emploi = $emploi;

        return $this;
    }

    /**
     * Get emploi
     *
     * @return Entity\Emplois
     */
    public function getEmploi()
    {
        return $this->emploi;
    }

    /**
     * Set projet
     *
     * @param Projets $projet
     *
     * @return EmploisHasProjets
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
}
