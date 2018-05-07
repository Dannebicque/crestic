<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Plateformes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlateformesRepository")
 * @Vich\Uploadable
 */
class Plateformes
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
     * @ORM\Column(name="nom", type="string", length=255,nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255,nullable=true)
     */
    private $localisation;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MembresCrestic",inversedBy="plateformes")
     * @ORM\JoinColumn(name="responsable_id",referencedColumnName="id")
     * @ORM\OrderBy({"nom" = "ASC"})
     */
    private $responsable;

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
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image = 'noimage.png';

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="plateformes_images", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url = '';

    /**
     *
     * @ORM\OneToMany(targetEntity="ProjetsHasPlateformes", mappedBy="plateforme", cascade={"persist"})
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     */
    private $projets;

    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsHasPlateformes", mappedBy="plateforme", cascade={"persist"})
     * @ORM\JoinColumn(name="plateforme_id", referencedColumnName="id")
     */
    private $publications;

    /**
     *
     * @ORM\OneToMany(targetEntity="PlateformesHasSliders", mappedBy="plateforme", cascade={"persist"})
     */
    private $sliders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projets = new ArrayCollection();
        $this->publications = new ArrayCollection();
        $this->sliders = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Plateformes
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

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
     * Set id
     *
     * @param $id
     *
     * @return Plateformes
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set localisation
     *
     * @param string $localisation
     *
     * @return Plateformes
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return MembresCrestic
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set responsable
     *
     * @param MembresCrestic $responsable
     *
     * @return Plateformes
     */
    public function setResponsable(MembresCrestic $responsable = null)
    {
        $this->responsable = $responsable;

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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Plateformes
     */
    public function setCreated($created)
    {
        $this->created = $created;

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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Plateformes
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Plateformes
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Plateformes
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Set image
     *
     * @param string $image
     *
     * @return Plateformes
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
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

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdated(new \DateTime('now'));
        }
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
     * Set url
     *
     * @param string $url
     *
     * @return Plateformes
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Add projet
     *
     * @param ProjetsHasPlateformes $projet
     *
     * @return Plateformes
     */
    public function addProjet(ProjetsHasPlateformes $projet)
    {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param ProjetsHasPlateformes $projet
     */
    public function removeProjet(ProjetsHasPlateformes $projet)
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
     * Add publication
     *
     * @param PublicationsHasPlateformes $publication
     *
     * @return Plateformes
     */
    public function addPublication(PublicationsHasPlateformes $publication)
    {
        $this->publications[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param PublicationsHasPlateformes $publication
     */
    public function removePublication(PublicationsHasPlateformes $publication)
    {
        $this->publications->removeElement($publication);
    }

    /**
     * Get publications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublications()
    {
        return $this->publications;
    }

    /**
     * Add slider
     *
     * @param Slider $slider
     *
     * @return Plateformes
     */
    public function addSlider(Slider $slider)
    {
        $this->sliders[] = $slider;

        return $this;
    }

    /**
     * Remove slider
     *
     * @param Slider $slider
     */
    public function removeSlider(Slider $slider)
    {
        $this->sliders->removeElement($slider);
    }

    /**
     * Get sliders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSliders()
    {
        return $this->sliders;
    }
}
