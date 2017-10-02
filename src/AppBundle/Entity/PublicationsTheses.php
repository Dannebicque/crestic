<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsTheses
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsThesesRepository")
 */
class PublicationsTheses extends Publications
{
    protected $type = 'these';
    protected $couleur = "#817FB2";

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
     * @var \DateTime
     *
     * @ORM\Column(name="dateSoutenance", type="date",nullable=true)
     */
    private $dateSoutenance;

    /**
     * @var string
     *
     * @ORM\Column(name="phdorhdr", type="string", length= 3)
     */
    private $phdorhdr = 'phd';

    /**
     * @var string
     *
     * @ORM\Column(name="departement", type="string", length= 255, nullable=true)
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\Column(name="discipline", type="string", length= 255, nullable=true)
     */
    private $discipline;

    /**
     * @var string
     *
     * @ORM\Column(name="abbrevDepartement", type="string", length= 100, nullable=true)
     */
    private $abbrevDepartement;

    /**
     * @var string
     *
     * @ORM\Column(name="universite", type="string", length= 255, nullable=true)
     */
    private $universite;

    /**
     * @var string
     *
     * @ORM\Column(name="abbrevUniversite", type="string", length= 100, nullable=true)
     */
    private $abbrevUniversite;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     */
    private $pays;

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
     * Get dateSoutenance
     *
     * @return \DateTime
     */
    public function getDateSoutenance()
    {
        return $this->dateSoutenance;
    }

    /**
     * Set dateSoutenance
     *
     * @param \DateTime $dateSoutenance
     *
     * @return PublicationsTheses
     */
    public function setDateSoutenance($dateSoutenance)
    {
        $this->dateSoutenance = $dateSoutenance;

        return $this;
    }

    /**
     * Set departement
     *
     * @param string $departement
     *
     * @return PublicationsTheses
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return string
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set abbrevDepartement
     *
     * @param string $abbrevDepartement
     *
     * @return PublicationsTheses
     */
    public function setAbbrevDepartement($abbrevDepartement)
    {
        $this->abbrevDepartement = $abbrevDepartement;

        return $this;
    }

    /**
     * Get abbrevDepartement
     *
     * @return string
     */
    public function getAbbrevDepartement()
    {
        return $this->abbrevDepartement;
    }

    /**
     * Set universite
     *
     * @param string $universite
     *
     * @return PublicationsTheses
     */
    public function setUniversite($universite)
    {
        $this->universite = $universite;

        return $this;
    }

    /**
     * Get universite
     *
     * @return string
     */
    public function getUniversite()
    {
        return $this->universite;
    }

    /**
     * Set abbrevUniversite
     *
     * @param string $abbrevUniversite
     *
     * @return PublicationsTheses
     */
    public function setAbbrevUniversite($abbrevUniversite)
    {
        $this->abbrevUniversite = $abbrevUniversite;

        return $this;
    }

    /**
     * Get abbrevUniversite
     *
     * @return string
     */
    public function getAbbrevUniversite()
    {
        return $this->abbrevUniversite;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return PublicationsTheses
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

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
     * Set pays
     *
     * @param Pays $pays
     *
     * @return PublicationsTheses
     */
    public function setPays(Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return Pays
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set phdorhdr
     *
     * @param string $phdorhdr
     *
     * @return PublicationsTheses
     */
    public function setPhdorhdr($phdorhdr)
    {
        $this->phdorhdr = $phdorhdr;

        return $this;
    }

    /**
     * Get phdorhdr
     *
     * @return string
     */
    public function getPhdorhdr()
    {
        return $this->phdorhdr;
    }

    /**
     * Set discipline
     *
     * @param string $discipline
     *
     * @return PublicationsTheses
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;

        return $this;
    }

    /**
     * Get discipline
     *
     * @return string
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }
}
