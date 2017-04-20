<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsBrevets
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsBrevetsRepository")
 */
class PublicationsBrevets extends Publications
{
    protected $type = 'brevet';


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
     * @ORM\Column(name="dateDepot", type="date",nullable=true)
     */
    private $dateDepot;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeroDepot", type="integer", nullable=true)
     */
    private $numeroDepot;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDelivrance", type="date",nullable=true)
     */
    private $dateDelivrance;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeroDelivrance", type="integer", nullable=true)
     */
    private $numeroDelivrance;

    /**
     * @var string
     *
     * @ORM\Column(name="secteur", type="string", length=255, nullable=true)
     */
    private $secteur;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumn(name="pays_id",referencedColumnName="id")
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
     * Set dateDepot
     *
     * @param \DateTime $dateDepot
     *
     * @return PublicationsBrevets
     */
    public function setDateDepot($dateDepot)
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    /**
     * Get dateDepot
     *
     * @return \DateTime
     */
    public function getDateDepot()
    {
        $result = null;
        if ($this->dateDepot != null)
        {
            $date = \DateTime::createFromFormat('d/m/Y', $this->dateDepot->format('d/m/y'));
            if ($date) {
                $result = $this->dateDepot;
            }
        }
        return $result;
    }

    /**
     * Set numeroDepot
     *
     * @param integer $numeroDepot
     *
     * @return PublicationsBrevets
     */
    public function setNumeroDepot($numeroDepot)
    {
        $this->numeroDepot = $numeroDepot;

        return $this;
    }

    /**
     * Get numeroDepot
     *
     * @return integer
     */
    public function getNumeroDepot()
    {
        return $this->numeroDepot;
    }

    /**
     * Set dateDelivrance
     *
     * @param \DateTime $dateDelivrance
     *
     * @return PublicationsBrevets
     */
    public function setDateDelivrance($dateDelivrance)
    {
        $this->dateDelivrance = $dateDelivrance;

        return $this;
    }

    /**
     * Get dateDelivrance
     *
     * @return \DateTime
     */
    public function getDateDelivrance()
    {
        $result = null;

        if ($this->dateDelivrance != null)
        {
            $date = \DateTime::createFromFormat('d/m/Y', $this->dateDelivrance->format('d/m/y'));
            if ($date) {
                $result = $this->dateDelivrance;
            }
        }
        return $result;
    }

    /**
     * Set numeroDelivrance
     *
     * @param integer $numeroDelivrance
     *
     * @return PublicationsBrevets
     */
    public function setNumeroDelivrance($numeroDelivrance)
    {
        $this->numeroDelivrance = $numeroDelivrance;

        return $this;
    }

    /**
     * Get numeroDelivrance
     *
     * @return integer
     */
    public function getNumeroDelivrance()
    {
        return $this->numeroDelivrance;
    }

    /**
     * Set secteur
     *
     * @param string $secteur
     *
     * @return PublicationsBrevets
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur
     *
     * @return string
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return PublicationsBrevets
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

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
}
