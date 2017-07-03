<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Projets
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjetsRepository")
 * @Vich\Uploadable
 */
class Projets
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
     * @ORM\Column(name="titre", type="string", length=255,nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    private $description;

    /**
     * @Gedmo\Slug(fields={"titre"})
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
     * @Vich\UploadableField(mapping="projets_images", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="definestime", type="date")
     */
    private $dateFin;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MembresCrestic", inversedBy="equipes",cascade={"persist"})
     * @ORM\JoinColumn(name="responable_id",referencedColumnName="id")
     */
    private $responsable;

    /**
    * @var string
    *
    * @ORM\Column(name="financement", type="string", length=255,nullable=true)
    */
    private $financement;

    /**
     * @var string
     *
     * @ORM\Column(name="identification", type="string", length=255,nullable=true)
     */
    private $identification;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255,nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="budgetGlobal", type="decimal",nullable=true)
     */
    private $budgetGlobal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif = true;

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
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255,nullable=true)
     */
    private $video;

    /**
     * @var boolean
     *
     * @ORM\Column(name="projetInternational", type="boolean")
     */
    private $projetInternational = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="projetValorisation", type="boolean")
     */
    private $projetValorisation = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="projetThese", type="boolean")
     */
    private $projetThese = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="projetRi", type="boolean")
     */
    private $projetRi = false;

    /**
     *
     * @ORM\OneToMany(targetEntity="ProjetsHasEquipes", mappedBy="projet", cascade={"persist"})
     */
    private $equipes;

    /**
     *
     * @ORM\OneToMany(targetEntity="ProjetsHasMembres", mappedBy="projet", cascade={"persist"})
     */
    private $membres;

    /**
     *
     * @ORM\OneToMany(targetEntity="ProjetsHasPartenaires", mappedBy="projet", cascade={"persist"})
     */
    private $partenaires;

    /**
     *
     * @ORM\OneToMany(targetEntity="ProjetsHasPlateformes", mappedBy="projet", cascade={"persist"})
     */
    private $plateformes;

    /**
     *
     * @ORM\OneToMany(targetEntity="ProjetsHasSliders", mappedBy="projet", cascade={"persist"})
     */
    private $sliders;

    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsHasProjets", mappedBy="projet")
     */
    private $publications;


    /**
     * @ORM\OneToMany(targetEntity="Emplois", mappedBy="projet", fetch="EAGER")
     */
    private $emplois;

    public function __toString()
    {
        return ''.$this->getTitre();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipes      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publications = new \Doctrine\Common\Collections\ArrayCollection();
        $this->membres      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->partenaires  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->plateformes  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sliders      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emplois      = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Projets
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
     * Set description
     *
     * @param string $description
     *
     * @return Projets
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Projets
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Projets
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
 * Set financement
 *
 * @param string $financement
 *
 * @return Projets
 */
    public function setFinancement($financement)
    {
        $this->financement = $financement;

        return $this;
    }

    /**
     * Get financement
     *
     * @return string
     */
    public function getFinancement()
    {
        return $this->financement;
    }

    /**
     * Set identification
     *
     * @param string $identification
     *
     * @return Projets
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;

        return $this;
    }

    /**
     * Get identification
     *
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * Set budgetGlobal
     *
     * @param string $budgetGlobal
     *
     * @return Projets
     */
    public function setBudgetGlobal($budgetGlobal)
    {
        $this->budgetGlobal = $budgetGlobal;

        return $this;
    }

    /**
     * Get budgetGlobal
     *
     * @return string
     */
    public function getBudgetGlobal()
    {
        return $this->budgetGlobal;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Projets
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Projets
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
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
     * @return Projets
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Projets
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
     * @return Projets
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
     * Set responsable
     *
     * @param MembresCrestic $responsable
     *
     * @return Projets
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
     * Set url
     *
     * @param string $url
     *
     * @return Projets
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
     * Set video
     *
     * @param string $video
     *
     * @return Projets
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
     * Set projetInternational
     *
     * @param boolean $projetInternational
     *
     * @return Projets
     */
    public function setProjetInternational($projetInternational)
    {
        $this->projetInternational = $projetInternational;

        return $this;
    }

    /**
     * Get projetInternational
     *
     * @return boolean
     */
    public function getProjetInternational()
    {
        return $this->projetInternational;
    }

    /**
     * Set projetValorisation
     *
     * @param boolean $projetValorisation
     *
     * @return Projets
     */
    public function setProjetValorisation($projetValorisation)
    {
        $this->projetValorisation = $projetValorisation;

        return $this;
    }

    /**
     * Get projetValorisation
     *
     * @return boolean
     */
    public function getProjetValorisation()
    {
        return $this->projetValorisation;
    }

    /**
     * Set projetThese
     *
     * @param boolean $projetThese
     *
     * @return Projets
     */
    public function setProjetThese($projetThese)
    {
        $this->projetThese = $projetThese;

        return $this;
    }

    /**
     * Get projetThese
     *
     * @return boolean
     */
    public function getProjetThese()
    {
        return $this->projetThese;
    }

    /**
     * Set projetRi
     *
     * @param boolean $projetRi
     *
     * @return Projets
     */
    public function setProjetRi($projetRi)
    {
        $this->projetRi = $projetRi;

        return $this;
    }

    /**
     * Get projetRi
     *
     * @return boolean
     */
    public function getProjetRi()
    {
        return $this->projetRi;
    }

    /**
     * Add equipe
     *
     * @param ProjetsHasEquipes $equipe
     *
     * @return Projets
     */
    public function addEquipe(ProjetsHasEquipes $equipe)
    {
        $this->equipes[] = $equipe;

        return $this;
    }

    /**
     * Remove equipe
     *
     * @param ProjetsHasEquipes $equipe
     */
    public function removeEquipe(ProjetsHasEquipes $equipe)
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
     * Add membre
     *
     * @param ProjetsHasMembres $membre
     *
     * @return Projets
     */
    public function addMembre(ProjetsHasMembres $membre)
    {
        $this->membres[] = $membre;

        return $this;
    }

    /**
     * Remove membre
     *
     * @param ProjetsHasMembres $membre
     */
    public function removeMembre(ProjetsHasMembres $membre)
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
     * Add partenaire
     *
     * @param ProjetsHasPartenaires $partenaire
     *
     * @return Projets
     */
    public function addPartenaire(ProjetsHasPartenaires $partenaire)
    {
        $this->partenaires[] = $partenaire;

        return $this;
    }

    /**
     * Remove partenaire
     *
     * @param ProjetsHasPartenaires $partenaire
     */
    public function removePartenaire(ProjetsHasPartenaires $partenaire)
    {
        $this->partenaires->removeElement($partenaire);
    }

    /**
     * Get partenaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartenaires()
    {
        return $this->partenaires;
    }

    /**
     * Add plateforme
     *
     * @param ProjetsHasPlateformes $plateforme
     *
     * @return Projets
     */
    public function addPlateforme(ProjetsHasPlateformes $plateforme)
    {
        $this->plateformes[] = $plateforme;

        return $this;
    }

    /**
     * Remove plateforme
     *
     * @param ProjetsHasPlateformes $plateforme
     */
    public function removePlateforme(ProjetsHasPlateformes $plateforme)
    {
        $this->plateformes->removeElement($plateforme);
    }

    /**
     * Get plateformes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlateformes()
    {
        return $this->plateformes;
    }

    /**
     * Add plateformes
     *
     * @param ProjetsHasSliders $plateformes
     *
     * @return Projets
     */
    public function addPlateformes(ProjetsHasPlateformes $plateformes)
    {
        $this->plateformes[] = $plateformes;

        return $this;
    }

    /**
     * Remove slider
     *
     * @param ProjetsHasSliders $slider
     */
    public function removeSlider(ProjetsHasSliders $slider)
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
     * Add slider
     *
     * @param ProjetsHasSliders $slider
     *
     * @return Projets
     */
    public function addSlider(ProjetsHasSliders $slider)
    {
        $this->sliders[] = $slider;

        return $this;
    }

    /**
     * Add publication
     *
     * @param PublicationsHasProjets $publication
     *
     * @return Projets
     */
    public function addPublication(PublicationsHasProjets $publication)
    {
        $this->publications[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param PublicationsHasProjets $publication
     */
    public function removePublication(PublicationsHasProjets $publication)
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
     * Add emploi
     *
     * @param Emplois $emploi
     *
     * @return Emplois
     */
    public function addEmploi(Emplois $emploi)
    {
        $this->emplois[] = $emploi;

        return $this;
    }

    /**
     * Remove emploi
     *
     * @param Emplois $emploi
     */
    public function removeEmploi(Emplois $emploi)
    {
        $this->emplois->removeElement($emploi);
    }

    /**
     * Get emploi
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmplois()
    {
        return $this->emplois;
    }

    /**
     * Add emplois
     *
     * @param \AppBundle\Entity\Emplois $emplois
     *
     * @return Projets
     */
    public function addEmplois(\AppBundle\Entity\Emplois $emplois)
    {
        $this->emplois[] = $emplois;

        return $this;
    }

    /**
     * Remove emplois
     *
     * @param \AppBundle\Entity\Emplois $emplois
     */
    public function removeEmplois(\AppBundle\Entity\Emplois $emplois)
    {
        $this->emplois->removeElement($emplois);
    }
}
