<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * EquipesHasMembres
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipesHasMembresRepository")
 */
class EquipesHasMembres
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
     * @ORM\ManyToOne(targetEntity="Equipes",inversedBy="membres")
     * @ORM\JoinColumn(name="equipe_id", referencedColumnName="id")
     */
    private $equipe;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MembresCrestic",inversedBy="equipesHasMembres")
     * @ORM\JoinColumn(name="membreCrestic_id",referencedColumnName="id")
     */
    private $membreCrestic;

    public function __toString()
    {
        return $this->getEquipe().' '.$this->getMembreCrestic();
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
     * Set equipe
     *
     * @param Equipes $equipe
     *
     * @return EquipesHasMembres
     */
    public function setEquipe(Equipes $equipe = null)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return Equipes
     */
    public function getEquipe()
    {
        return $this->equipe;
    }

    /**
     * Set membre
     *
     * @param MembresCrestic|null $membreCrestic
     *
     * @return EquipesHasMembres
     */
    public function setMembreCrestic(MembresCrestic $membreCrestic = null)
    {
        $this->membreCrestic = $membreCrestic;

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
