<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlocNewsletter
 *
 * @ORM\Table(name="bloc_newsletter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlocNewsletterRepository")
 */
class BlocNewsletter
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Newsletter", mappedBy="blocs")
     */
    private $newletter;


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
     * @return BlocNewsletter
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
     * Set text
     *
     * @param string $text
     *
     * @return BlocNewsletter
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return BlocNewsletter
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return BlocNewsletter
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->newletter = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add newletter
     *
     * @param \AppBundle\Entity\Newsletter $newletter
     *
     * @return BlocNewsletter
     */
    public function addNewletter(\AppBundle\Entity\Newsletter $newletter)
    {
        $this->newletter[] = $newletter;

        return $this;
    }

    /**
     * Remove newletter
     *
     * @param \AppBundle\Entity\Newsletter $newletter
     */
    public function removeNewletter(\AppBundle\Entity\Newsletter $newletter)
    {
        $this->newletter->removeElement($newletter);
    }

    /**
     * Get newletter
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewletter()
    {
        return $this->newletter;
    }
}
