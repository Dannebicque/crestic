<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsRapports
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsRapportsRepository")
 */
class PublicationsRapports  extends Publications
{
    protected $type = 'rapport';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=200, nullable=true)
     */
    private $ville = '';

    /**
     * @var string
     *
     * @ORM\Column(name="AbbrevCompany", type="string", length=200, nullable=true)
     */
    private $abbrevCompany = '';

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
     * Set numero
     *
     * @param integer $numero
     *
     * @return PublicationsRapports
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set ville
     *
     * @param integer $ville
     *
     * @return PublicationsRapports
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return integer
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set abbrevCompany
     *
     * @param string $abbrevCompany
     *
     * @return PublicationsRapports
     */
    public function setAbbrevCompany($abbrevCompany)
    {
        $this->abbrevCompany = $abbrevCompany;

        return $this;
    }

    /**
     * Get abbrevCompany
     *
     * @return string
     */
    public function getAbbrevCompany()
    {
        return $this->abbrevCompany;
    }
}
