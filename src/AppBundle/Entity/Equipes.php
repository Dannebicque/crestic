<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Equipes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipesRepository")
 * @Vich\Uploadable
 *
 */
class Equipes
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
     * @ORM\Column(name="nomlong", type="string", length=255, nullable=true)
     */
    private $nomlong;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean",nullable=true)
     */
    private $active=True;

    /**
     * @var string
     *
     * @ORM\Column(name="themeRecherche", type="text",nullable=true)

     */
    private $themeRecherche;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="MembresCrestic", inversedBy="equipes",cascade={"persist"})
     * @ORM\JoinColumn(name="responsable_id",referencedColumnName="id")
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
     *
     * @ORM\OneToMany(targetEntity="EquipesHasMembres", mappedBy="equipe",cascade={"persist"})
     */
    private $membres;

    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsHasEquipes", mappedBy="equipe")
     * @ORM\JoinColumn(name="equipe_id",referencedColumnName="id")
     */
    private $publications;

    /**
     *
     * @ORM\OneToMany(targetEntity="EquipesHasDepartements", mappedBy="equipe", cascade={"persist"})
     * @ORM\JoinColumn(name="departement_id",referencedColumnName="id")
     */
    private $departements;

    /**
     *
     * @ORM\OneToMany(targetEntity="EquipesHasSliders", mappedBy="equipe", cascade={"persist"})
     * @ORM\JoinColumn(name="slider_id",referencedColumnName="id")
     */
    private $sliders;

    /**
     *
     * @ORM\OneToMany(targetEntity="ProjetsHasEquipes", mappedBy="equipe", cascade={"persist"})
     */
    private $projets;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image = 'noimage.png';

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="equipes_images", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video = '';

    public function __toString()
    {
        return $this->getNom();
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
     * @return integer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Equipes
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
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
     * Set themeRecherche
     *
     * @param string $themeRecherche
     *
     * @return Equipes
     */
    public function setThemeRecherche($themeRecherche)
    {
        $this->themeRecherche = $themeRecherche;

        return $this;
    }

    /**
     * Get themeRecherche
     *
     * @return string
     */
    public function getThemeRecherche()
    {
        return $this->themeRecherche;
    }

    /**
     * Set responsable
     *
     * @param MembresCrestic $responsable
     *
     * @return Equipes
     */
    public function setResponsable(MembresCrestic $responsable = null)
    {
        $this->responsable = $responsable;

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
     * Constructor
     */
    public function __construct()
    {
        $this->membres      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projets      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publications = new \Doctrine\Common\Collections\ArrayCollection();
        $this->departements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sliders      = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Equipes
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
     * @return Equipes
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
     * Add membre
     *
     * @param EquipesHasMembres $membre
     *
     * @return Equipes
     */
    public function addMembre(EquipesHasMembres $membre)
    {
        $this->membres[] = $membre;

        return $this;
    }

    /**
     * Remove membre
     *
     * @param EquipesHasMembres $membre
     */
    public function removeMembre(EquipesHasMembres $membre)
    {
        $this->membres->removeElement($membre);
    }

    /**
     * Get membres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembres()
    {
        return $this->membres;
    }


    /**
     * Add departement
     *
     * @param EquipesHasDepartements $departement
     *
     * @return Equipes
     */
    public function addDepartement(EquipesHasDepartements $departement)
    {
        $this->departements[] = $departement;

        return $this;
    }

    /**
     * Remove departements
     *
     * @param EquipesHasDepartements $departement
     */
    public function removeDepartement(EquipesHasMembres $departement)
    {
        $this->departements->removeElement($departement);
    }

    /**
     * Get departements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartements()
    {
        return $this->departements;
    }


    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Equipes
     */
    public function setSlug($slug)
    {
        $this->slug = $this->generate_slug(''.$this->getNom());

        return $this;
    }

    /**
     * Add publication
     *
     * @param PublicationsHasEquipes $publication
     *
     * @return Equipes
     */
    public function addPublication(PublicationsHasEquipes $publication)
    {
        $this->publications[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param PublicationsHasEquipes $publication
     */
    public function removePublication(PublicationsHasEquipes $publication)
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
     * @return Equipes
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

        if ($image)
        {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdated(new \DateTime('now'));
        }
    }

    /**
     * Set video
     *
     * @param string $video
     *
     * @return Equipes
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Equipes
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add slider
     *
     * @param EquipesHasSliders $slider
     *
     * @return Equipes
     */
    public function addSlider(EquipesHasSliders $slider)
    {
        $this->sliders[] = $slider;

        return $this;
    }

    /**
     * Remove slider
     *
     * @param EquipesHasSliders $slider
     */
    public function removeSlider(EquipesHasSliders $slider)
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

    /**
     * Add projet
     *
     * @param ProjetsHasEquipes $projet
     *
     * @return Projets
     */
    public function addProjet(ProjetsHasEquipes $projet)
    {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param ProjetsHasEquipes $projet
     */
    public function removeProjet(ProjetsHasEquipes $projet)
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
     * Set nomlong
     *
     * @param string $nomlong
     *
     * @return Equipes
     */
    public function setNomlong($nomlong)
    {
        $this->nomlong = $nomlong;

        return $this;
    }

    /**
     * Get nomlong
     *
     * @return string
     */
    public function getNomlong()
    {
        return $this->nomlong;
    }
}
