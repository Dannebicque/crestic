<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MembresHasReseaux
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MembresHasReseauxRepository")
 */
class MembresHasReseaux
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
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Reseaux",inversedBy="reseaux")
     * @ORM\JoinColumn(name="reseau_id",referencedColumnName="id")
     */
    private $reseau;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MembresCrestic", inversedBy="reseaux")
     * @ORM\JoinColumn(name="membreCrestic_id",referencedColumnName="id")
     */
    private $membreCrestic;


    public function __toString()
    {
        return $this->getReseau().' '.$this->getMembreCrestic();
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
     * @return MembresHasReseaux
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return MembresHasReseaux
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set reseau
     *
     * @param Reseaux $reseau
     *
     * @return MembresHasReseaux
     */
    public function setReseau(Reseaux $reseau = null)
    {
        $this->reseau = $reseau;

        return $this;
    }

    /**
     * Get reseau
     *
     * @return Reseaux
     */
    public function getReseau()
    {
        return $this->reseau;
    }

    /**
     * Set membre
     *
     * @param MembresCrestic $membre
     *
     * @return MembresHasReseaux
     */
    public function setMembreCrestic(MembresCrestic $membre = null)
    {
        $this->membreCrestic = $membre;

        return $this;
    }

    /**
     * Get membre
     *
     * @return MembresCrestic
     */
    public function getMembreCrestic()
    {
        return $this->membreCrestic;
    }
}
