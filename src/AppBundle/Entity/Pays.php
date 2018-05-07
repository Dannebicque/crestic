<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cms
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaysRepository")
 */
class Pays
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
     * @var integer
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="alpha2", type="string", length=255)
     */
    private $alpha2;

    /**
     * @var string
     *
     * @ORM\Column(name="alpha3", type="string", length=255)
     */
    private $alpha3;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEN", type="string", length=255)
     */
    private $nomEN;

    /**
     * @var string
     *
     * @ORM\Column(name="nomFR", type="string", length=255)
     */
    private $nomFR;

    /**
     * @ORM\OneToMany(targetEntity="DemandeOM", mappedBy="pays")
     */
    private $demandesOM;

    public function __construct()
    {
        $this->demandesOM = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNomFR();
    }

    /**
     * Get nomFR
     *
     * @return string
     */
    public function getNomFR()
    {
        return $this->nomFR;
    }

    /**
     * Set nomFR
     *
     * @param string $nomFR
     *
     * @return Pays
     */
    public function setNomFR($nomFR)
    {
        $this->nomFR = $nomFR;

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
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return Pays
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get alpha2
     *
     * @return string
     */
    public function getAlpha2()
    {
        return $this->alpha2;
    }

    /**
     * Set alpha2
     *
     * @param string $alpha2
     *
     * @return Pays
     */
    public function setAlpha2($alpha2)
    {
        $this->alpha2 = $alpha2;

        return $this;
    }

    /**
     * Get alpha3
     *
     * @return string
     */
    public function getAlpha3()
    {
        return $this->alpha3;
    }

    /**
     * Set alpha3
     *
     * @param string $alpha3
     *
     * @return Pays
     */
    public function setAlpha3($alpha3)
    {
        $this->alpha3 = $alpha3;

        return $this;
    }

    /**
     * Get nomEN
     *
     * @return string
     */
    public function getNomEN()
    {
        return $this->nomEN;
    }

    /**
     * Set nomEN
     *
     * @param string $nomEN
     *
     * @return Pays
     */
    public function setNomEN($nomEN)
    {
        $this->nomEN = $nomEN;

        return $this;
    }

    /**
     * Add demandeOM
     *
     * @param DemandeOM $demandeOM
     *
     * @return Pays
     */
    public function addDemandeOM(DemandeOM $demandeOM)
    {
        $this->demandesOM[] = $demandeOM;

        return $this;
    }

    /**
     * Remove demandeOM
     *
     * @param DemandeOM
     */
    public function removeDemandeOM(DemandeOM $demandeOM)
    {
        $this->demandesOM->removeElement($demandeOM);
    }

    /**
     * Get equipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandesOM()
    {
        return $this->demandesOM;
    }

    /**
     * Add demandesOM
     *
     * @param DemandeOM $demandesOM
     *
     * @return Pays
     */
    public function addDemandesOM(DemandeOM $demandesOM)
    {
        $this->demandesOM[] = $demandesOM;

        return $this;
    }

    /**
     * Remove demandesOM
     *
     * @param DemandeOM $demandesOM
     */
    public function removeDemandesOM(DemandeOM $demandesOM)
    {
        $this->demandesOM->removeElement($demandesOM);
    }
}
