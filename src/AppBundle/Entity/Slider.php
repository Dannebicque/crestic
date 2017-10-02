<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Slider
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SliderRepository")
 * @Vich\Uploadable
 */
class Slider
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
     * @ORM\Column(name="image", type="string", length=100)
     */
    private $image='noimage.png';

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="slider_images", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255,nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255,nullable=true)
     */
    private $texte;

    /**
     * @var \DateTime $created
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     *
     * @ORM\OneToMany(targetEntity="EquipesHasSliders", mappedBy="slider", cascade={"persist"})
     */
    private $equipes;

    /**
     *
     * @ORM\OneToMany(targetEntity="ProjetsHasSliders", mappedBy="slider", cascade={"persist"})
     */
    private $projets;

    /**
     *
     * @ORM\OneToMany(targetEntity="PlateformesHasSliders", mappedBy="slider", cascade={"persist"})
     */
    private $plateformes;

    /**
     * @ORM\ManyToOne(targetEntity="MembresCrestic")
     * @ORM\OrderBy({"nom" = "ASC"})
     */
    private $auteur;

    public function __construct()
    {
        $this->equipes      = new ArrayCollection();
        $this->projets      = new ArrayCollection();
        $this->plateformes  = new ArrayCollection();
    }

    public function __toString()
    {
        return ''.$this->getTitre();
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
     * Set image
     *
     * @param string $image
     *
     * @return Slider
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
     * Set url
     *
     * @param string $url
     *
     * @return Slider
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return Slider
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image)
        {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdated(new \DateTime('now'));
        }
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Slider
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Slider
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Slider
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
     * Add equipe
     *
     * @param EquipesHasSliders $equipe
     *
     * @return Equipes
     */
    public function addEquipe(EquipesHasSliders $equipe)
    {
        $this->equipes[] = $equipe;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param EquipesHasSliders $equipe
     */
    public function removeEquipe(EquipesHasSliders $equipe)
    {
        $this->equipes->removeElement($equipe);
    }

    /**
     * Get equipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipes()
    {
        return $this->equipes;
    }

    /**
     * Add projet
     *
     * @param ProjetsHasSliders $projet
     *
     * @return Projets
     */
    public function addProjet(ProjetsHasSliders $projet)
    {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param ProjetsHasSliders $projet
     */
    public function removeProjet(ProjetsHasSliders $projet)
    {
        $this->projets->removeElement($projet);
    }

    /**
     * Get projets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjets()
    {
        return $this->projets;
    }

    /**
     * Add plateforme
     *
     * @param PlateformesHasSliders $plateforme
     *
     * @return Plateformes
     */
    public function addPlateforme(PlateformesHasSliders $plateforme)
    {
        $this->plateformes[] = $plateforme;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param PlateformesHasSliders $plateforme
     */
    public function removePlateforme(PlateformesHasSliders $plateforme)
    {
        $this->plateformes->removeElement($plateforme);
    }

    /**
     * Get projets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlateformes()
    {
        return $this->plateformes;
    }

    /**
     * Set auteur
     *
     * @param \AppBundle\Entity\MembresCrestic $auteur
     *
     * @return Slider
     */
    public function setAuteur(\AppBundle\Entity\MembresCrestic $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \AppBundle\Entity\MembresCrestic
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
}
