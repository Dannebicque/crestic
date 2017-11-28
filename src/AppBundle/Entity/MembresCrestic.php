<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\DateTime;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MembresCresticRepository")
 * @Vich\Uploadable
 */
class MembresCrestic extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="disciplineHCERES", type="string", length=255, nullable=true)
     */
    private $disciplinehceres;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hdr", type="boolean")
     */
    private $hdr = false;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="datenomination", type="datetime", nullable=true)
     */
    private $datenomination;

    /**
     * @var string
     *
     * @ORM\Column(name="corpsgrade", type="string", length=50, nullable=true)
     */
    private $corpsgrade;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="cnu", type="string", length=5, nullable=true)
     */
    private $cnu;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=4, nullable=true)
     */
    private $status; //PR, MCF, IE, ADM, PUPH, MCUPH...

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=100, nullable=true)
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="batiment", type="string", length=50, nullable=true)
     */
    private $batiment;

    /**
     * @var string
     *
     * @ORM\Column(name="etage", type="string", length=50,nullable=true)
     */
    private $etage;

    /**
     * @var string
     *
     * @ORM\Column(name="bureau", type="string", length=20, nullable=true)
     */
    private $bureau;

    /**
     * @var string
     *
     * @ORM\Column(name="emailPerso", type="string", length=255, nullable=true)
     */
    private $emailPerso;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="Departements", inversedBy="membres")
     */
    private $departementMembre;

    /**
     * @ORM\OneToMany(targetEntity="Actualites", mappedBy="membreCrestic")
     */
    private $actualites;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Activites", mappedBy="membreCrestic")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="Emplois", mappedBy="contact")
     */
    private $emplois;

    /**
     * @ORM\OneToMany(targetEntity="MembresHasReseaux", mappedBy="membreCrestic")
     */
    private $reseaux;


    /**
     * @ORM\OneToMany(targetEntity="ProjetsHasMembres", mappedBy="membreCrestic")
     */
    private $projets;

    /**
     * @ORM\OneToMany(targetEntity="Plateformes", mappedBy="responsable")
     */
    private $plateformes;

    /**
     * @ORM\OneToMany(targetEntity="PublicationsHasMembres", mappedBy="membreCrestic")
     */
    private $publicationsHasMembres;

    /**
     * @ORM\OneToMany(targetEntity="EquipesHasMembres", mappedBy="membreCrestic")
     */
    private $equipesHasMembres;

    /**
     * @ORM\OneToMany(targetEntity="DemandeOM", mappedBy="membreCrestic")
     */
    private $demandesOM;

    /**
     * @ORM\OneToMany(targetEntity="Equipes", mappedBy="responsable")
     */
    private $equipes;

    /**
     * @ORM\OneToMany(targetEntity="Departements", mappedBy="membreCrestic")
     */
    private $departements;

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
     * @Vich\UploadableField(mapping="membresCrestic_images", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date",nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adressePerso", type="string", length=255, nullable=true)
     */
    private $adressePerso;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="telPortable", type="string", length=255, nullable=true)
     */
    private $telPortable;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="text", nullable=true)
     */
    private $cv;

    /**
     * @var string
     *
     * @ORM\Column(name="themes", type="text", nullable=true)
     */
    private $themes;


    /**
     * @var string
     *
     * @ORM\Column(name="responsabilitesScientifiques", type="text", nullable=true)
     */
    private $responsabilitesScientifiques;

    /**
     * @var string
     *
     * @ORM\Column(name="responsabilitesAdministratives", type="text", nullable=true)
     */
    private $responsabilitesAdministratives;

    /**
     * @var string
     *
     * @ORM\Column(name="evaluation", type="text", nullable=true)
     */
    private $evaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="editorial", type="text", nullable=true)
     */
    private $editorial;


    /**
     * @var string
     *
     * @ORM\Column(name="valorisation", type="text", nullable=true)
     */
    private $valorisation;

    /**
     * @var string
     *
     * @ORM\Column(name="vulgarisation", type="text", nullable=true)
     */
    private $vulgarisation;

    /**
     * @var string
     *
     * @ORM\Column(name="international", type="text", nullable=true)
     */
    private $international;

    /**
     * @var boolean
     *
     * @ORM\Column(name="membreAssocie", type="boolean",nullable=true)
     */
    private $membreAssocie = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="membreConseilLabo", type="boolean",nullable=true)
     */
    private $membreConseilLabo = false;

    /**
     * @var string
     *
     * @ORM\Column(name="enseignements", type="text", nullable=true)
     */
    private $enseignements;

    /**
     * @var string
     *
     * @ORM\Column(name="responsabiliteFonction", type="text", nullable=true)
     */
    private $responsabiliteFonction;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ancienMembresCrestic", type="boolean")
     */
    private $ancienMembresCrestic = false;


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
     * @return MembresCrestic
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return MembresCrestic
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get adressePerso
     *
     * @return string
     */
    public function getAdressePerso()
    {
        return $this->adressePerso;
    }

    /**
     * Set adressePerso
     *
     * @param string $adressePerso
     *
     * @return MembresCrestic
     */
    public function setAdressePerso($adressePerso)
    {
        $this->adressePerso = $adressePerso;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return MembresCrestic
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get telPortable
     *
     * @return string
     */
    public function getTelPortable()
    {
        return $this->telPortable;
    }

    /**
     * Set telPortable
     *
     * @param string $telPortable
     *
     * @return MembresCrestic
     */
    public function setTelPortable($telPortable)
    {
        $this->telPortable = $telPortable;

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
     * Set url
     *
     * @param string $url
     *
     * @return MembresCrestic
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return MembresCrestic
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get themes
     *
     * @return string
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * Set themes
     *
     * @param string $themes
     *
     * @return MembresCrestic
     */
    public function setThemes($themes)
    {
        $this->themes = $themes;

        return $this;
    }

    /**
     * Get responsabilitesScientifiques
     *
     * @return string
     */
    public function getResponsabilitesScientifiques()
    {
        return $this->responsabilitesScientifiques;
    }

    /**
     * Set responsabilitesScientifiques
     *
     * @param string $responsabilitesScientifiques
     *
     * @return MembresCrestic
     */
    public function setResponsabilitesScientifiques($responsabilitesScientifiques)
    {
        $this->responsabilitesScientifiques = $responsabilitesScientifiques;

        return $this;
    }

    /**
     * Get responsabilitesAdministratives
     *
     * @return string
     */
    public function getResponsabilitesAdministratives()
    {
        return $this->responsabilitesAdministratives;
    }

    /**
     * Set responsabilitesAdministratives
     *
     * @param string $responsabilitesAdministratives
     *
     * @return MembresCrestic
     */
    public function setResponsabilitesAdministratives($responsabilitesAdministratives)
    {
        $this->responsabilitesAdministratives = $responsabilitesAdministratives;

        return $this;
    }

    /**
     * Get valorisation
     *
     * @return string
     */
    public function getValorisation()
    {
        return $this->valorisation;
    }

    /**
     * Set valorisation
     *
     * @param string $valorisation
     *
     * @return MembresCrestic
     */
    public function setValorisation($valorisation)
    {
        $this->valorisation = $valorisation;

        return $this;
    }

    /**
     * Get vulgarisation
     *
     * @return string
     */
    public function getVulgarisation()
    {
        return $this->vulgarisation;
    }

    /**
     * Set vulgarisation
     *
     * @param string $vulgarisation
     *
     * @return MembresCrestic
     */
    public function setVulgarisation($vulgarisation)
    {
        $this->vulgarisation = $vulgarisation;

        return $this;
    }

    /**
     * Get international
     *
     * @return string
     */
    public function getInternational()
    {
        return $this->international;
    }

    /**
     * Set international
     *
     * @param string $international
     *
     * @return MembresCrestic
     */
    public function setInternational($international)
    {
        $this->international = $international;

        return $this;
    }

    /**
     * Get enseignements
     *
     * @return string
     */
    public function getEnseignements()
    {
        return $this->enseignements;
    }

    /**
     * Set enseignements
     *
     * @param string $enseignements
     *
     * @return MembresCrestic
     */
    public function setEnseignements($enseignements)
    {
        $this->enseignements = $enseignements;

        return $this;
    }


    /**
     * Get ancienMembresCrestic
     *
     * @return boolean
     */
    public function getAncienMembresCrestic()
    {
        return $this->ancienMembresCrestic;
    }

    /**
     * Set ancienMembresCrestic
     *
     * @param boolean $ancienMembresCrestic
     *
     * @return MembresCrestic
     */
    public function setAncienMembresCrestic($ancienMembresCrestic)
    {
        $this->ancienMembresCrestic = $ancienMembresCrestic;

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

    public function __toString()
    {
        return $this->getDisplay();
    }


    /**
     * Membres constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->actualites               = new ArrayCollection();
        $this->emplois                  = new ArrayCollection();
        $this->reseaux                  = new ArrayCollection();
        $this->plateformes              = new ArrayCollection();
        $this->publicationsHasMembres   = new ArrayCollection();
        $this->equipesHasMembres        = new ArrayCollection();
        $this->demandesOM               = new ArrayCollection();
        $this->equipes                  = new ArrayCollection();
        $this->departements             = new ArrayCollection();
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return ucwords($this->nom);
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return MembresCrestic
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return ucwords($this->prenom);
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return MembresCrestic
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get emailPerso
     *
     * @return string
     */
    public function getEmailPerso()
    {
        return $this->emailPerso;
    }

    /**
     * Set emailPerso
     *
     * @param string $emailPerso
     *
     * @return MembresCrestic
     */
    public function setEmailPerso($emailPerso)
    {
        $this->emailPerso = $emailPerso;

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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return MembresCrestic
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Add actualite
     *
     * @param Actualites $actualite
     *
     * @return MembresCrestic
     */
    public function addActualite(Actualites $actualite)
    {
        $this->actualites[] = $actualite;

        return $this;
    }

    /**
     * Remove actualite
     *
     * @param Actualites $actualite
     */
    public function removeActualite(Actualites $actualite)
    {
        $this->actualites->removeElement($actualite);
    }

    /**
     * Get actualites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActualites()
    {
        return $this->actualites;
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
     * Add membresHasReseaux
     *
     * @param MembresHasReseaux $reseau
     *
     * @return MembresCrestic
     */
    public function addReseau(MembresHasReseaux $reseau)
    {
        $this->reseaux[] = $reseau;

        return $this;
    }

    /**
     * Remove membresHasReseaux
     *
     * @param MembresHasReseaux $reseau
     */
    public function removeReseau(MembresHasReseaux $reseau)
    {
        $this->reseaux->removeElement($reseau);
    }

    /**
     * Get membresHasReseaux
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReseaux()
    {
        return $this->reseaux;
    }


    /**
     * Add plateforme
     *
     * @param Plateformes $plateforme
     *
     * @return MembresCrestic
     */
    public function addPlateforme(Plateformes $plateforme)
    {
        $this->plateformes[] = $plateforme;

        return $this;
    }

    /**
     * Remove plateforme
     *
     * @param Plateformes $plateforme
     */
    public function removePlateforme(Plateformes $plateforme)
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
     * Add publicationsHasMembre
     *
     * @param PublicationsHasMembres $publicationsHasMembre
     *
     * @return MembresCrestic
     */
    public function addPublicationsHasMembre(PublicationsHasMembres $publicationsHasMembre)
    {
        $this->publicationsHasMembres[] = $publicationsHasMembre;

        return $this;
    }

    /**
     * Remove publicationsHasMembre
     *
     * @param PublicationsHasMembres $publicationsHasMembre
     */
    public function removePublicationsHasMembre(PublicationsHasMembres $publicationsHasMembre)
    {
        $this->publicationsHasMembres->removeElement($publicationsHasMembre);
    }

    /**
     * Get publicationsHasMembres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublicationsHasMembres()
    {
        return $this->publicationsHasMembres;
    }

    /**
     * Add equipesHasMembre
     *
     * @param EquipesHasMembres $equipesHasMembre
     *
     * @return MembresCrestic
     */
    public function addEquipesHasMembre(EquipesHasMembres $equipesHasMembre)
    {
        $this->equipesHasMembres[] = $equipesHasMembre;

        return $this;
    }

    /**
     * Remove equipesHasMembre
     *
     * @param EquipesHasMembres $equipesHasMembre
     */
    public function removeEquipesHasMembre(EquipesHasMembres $equipesHasMembre)
    {
        $this->equipesHasMembres->removeElement($equipesHasMembre);
    }

    /**
     * Get equipesHasMembres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipesHasMembres()
    {
        return $this->equipesHasMembres;
    }

    /**
     * Add demandesOM
     *
     * @param DemandeOM $demandesOM
     *
     * @return MembresCrestic
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

    /**
     * Get demandesOM
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandesOM()
    {
        return $this->demandesOM;
    }

    /**
     * Add equipe
     *
     * @param Equipes $equipe
     *
     * @return MembresCrestic
     */
    public function addEquipe(Equipes $equipe)
    {
        $this->equipes[] = $equipe;

        return $this;
    }

    /**
     * Remove equipe
     *
     * @param Equipes $equipe
     */
    public function removeEquipe(Equipes $equipe)
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
     * Add departement
     *
     * @param Departements $departement
     *
     * @return MembresCrestic
     */
    public function addDepartement(Departements $departement)
    {
        $this->departements[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param Departements $departement
     */
    public function removeDepartement(Departements $departement)
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
     * @return MembresCrestic
     */
    public function setSlug()
    {
        $this->slug = $this->generate_slug($this->prenom.'-'.$this->nom);

        return $this;
    }


    /**
     * Get statut
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return MembresCrestic
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     * @return MembresCrestic
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
     * @return MembresCrestic
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Set site
     *
     * @param string $site
     *
     * @return MembresCrestic
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set batiment
     *
     * @param string $batiment
     *
     * @return MembresCrestic
     */
    public function setBatiment($batiment)
    {
        $this->batiment = $batiment;

        return $this;
    }

    /**
     * Get batiment
     *
     * @return string
     */
    public function getBatiment()
    {
        return $this->batiment;
    }

    /**
     * Set etage
     *
     * @param string $etage
     *
     * @return MembresCrestic
     */
    public function setEtage($etage)
    {
        $this->etage = $etage;

        return $this;
    }

    /**
     * Get etage
     *
     * @return string
     */
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * Set bureau
     *
     * @param string $bureau
     *
     * @return MembresCrestic
     */
    public function setBureau($bureau)
    {
        $this->bureau = $bureau;

        return $this;
    }

    /**
     * Get bureau
     *
     * @return string
     */
    public function getBureau()
    {
        return $this->bureau;
    }

    /**
     * Set responsabiliteFonction
     *
     * @param string $responsabiliteFonction
     *
     * @return MembresCrestic
     */
    public function setResponsabiliteFonction($responsabiliteFonction)
    {
        $this->responsabiliteFonction = $responsabiliteFonction;

        return $this;
    }

    /**
     * Get responsabiliteFonction
     *
     * @return string
     */
    public function getResponsabiliteFonction()
    {
        return $this->responsabiliteFonction;
    }

    public function getInitialePrenom()
    {
        $prenom = str_replace(' ','-', $this->prenom);

        $tprenom = explode('-', $prenom);
        $texte = '';
        foreach ($tprenom as $item)
        {
            $texte .= strtoupper(substr($item,0,1)).'. ';
        }

        return $texte;
    }

    public function getAuteurIEEE()
    {
//        if ( ($this->getMembreCrestic() === null && $this->getMembreExterieur() === null) || ($this->getMembreCrestic() !== null && $this->getMembreExterieur() !== null))
//        {
//            return 'Err!';
//        } elseif ($this->membreCrestic !== null && $this->membreExterieur === null)
//        {
            //membre crestic
        return $this->getInitialePrenom().' '.$this->getNom();
//        } else
//        {
//            return $this->getMembreExterieur()->getInitialePrenom().' '.$this->getMembreExterieur()->getNom();
//        }
    }

    public function getDisplay()
    {
        return ucfirst($this->prenom)." ".mb_strtoupper($this->nom);
    }

    /**
     * @param $str
     *
     * @return string
     */
    public function generate_slug($str) {

        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/' => '-', ' ' => '-'
        );

        // -- Remove duplicated spaces
        $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $str);

        // -- Returns the slug
        return strtolower(strtr($str, $table));

    }

    /**
     * Set membreAssocie
     *
     * @param boolean $membreAssocie
     *
     * @return MembresCrestic
     */
    public function setMembreAssocie($membreAssocie)
    {
        $this->membreAssocie = $membreAssocie;

        return $this;
    }

    /**
     * Get membreAssocie
     *
     * @return boolean
     */
    public function getMembreAssocie()
    {
        return $this->membreAssocie;
    }

    /**
     * Set membreConseilLabo
     *
     * @param boolean $membreConseilLabo
     *
     * @return MembresCrestic
     */
    public function setMembreConseilLabo($membreConseilLabo)
    {
        $this->membreConseilLabo = $membreConseilLabo;

        return $this;
    }

    /**
     * Get membreConseilLabo
     *
     * @return boolean
     */
    public function getMembreConseilLabo()
    {
        return $this->membreConseilLabo;
    }

    public function getLocalisation()
    {
        $loc = array();
        if ($this->getSite() != '')
        {
            $loc[] = $this->getSite();
        }

        if ($this->getBatiment() != '')
        {
            $loc[] = 'bât. '.$this->getBatiment();
        }

//        if ($this->getEtage() != '')
//        {
//            $loc[] = ', étg. '.$this->getEtage();
//        }

        if ($this->getBureau() != '')
        {
            $loc[] = 'bur. '.$this->getBureau();
        }

        if (count($loc) > 0)
        {
            return implode(', ', $loc);
        } else
        {
            return '';
        }
    }

    /**
     * Set cnu
     *
     * @param string $cnu
     *
     * @return MembresCrestic
     */
    public function setCnu($cnu)
    {
        $this->cnu = $cnu;

        return $this;
    }

    /**
     * Get cnu
     *
     * @return string
     */
    public function getCnu()
    {
        return $this->cnu;
    }

    /**
     * Add emplois
     *
     * @param Emplois $emplois
     *
     * @return MembresCrestic
     */
    public function addEmplois(Emplois $emplois)
    {
        $this->emplois[] = $emplois;

        return $this;
    }

    /**
     * Remove emplois
     *
     * @param Emplois $emplois
     */
    public function removeEmplois(Emplois $emplois)
    {
        $this->emplois->removeElement($emplois);
    }

    /**
     * Add reseaux
     *
     * @param MembresHasReseaux $reseaux
     *
     * @return MembresCrestic
     */
    public function addReseaux(MembresHasReseaux $reseaux)
    {
        $this->reseaux[] = $reseaux;

        return $this;
    }

    /**
     * Remove reseaux
     *
     * @param MembresHasReseaux $reseaux
     */
    public function removeReseaux(MembresHasReseaux $reseaux)
    {
        $this->reseaux->removeElement($reseaux);
    }

    /**
     * Add projet
     *
     * @param ProjetsHasMembres $projet
     *
     * @return MembresCrestic
     */
    public function addProjet(ProjetsHasMembres $projet)
    {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param ProjetsHasMembres $projet
     */
    public function removeProjet(ProjetsHasMembres $projet)
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
     * Set role
     *
     * @param string $role
     *
     * @return MembresCrestic
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set disciplinehceres
     *
     * @param string $disciplinehceres
     *
     * @return MembresCrestic
     */
    public function setDisciplinehceres($disciplinehceres)
    {
        $this->disciplinehceres = $disciplinehceres;

        return $this;
    }

    /**
     * Get disciplinehceres
     *
     * @return string
     */
    public function getDisciplinehceres()
    {
        return $this->disciplinehceres;
    }

    /**
     * Set hdr
     *
     * @param boolean $hdr
     *
     * @return MembresCrestic
     */
    public function setHdr($hdr)
    {
        $this->hdr = $hdr;

        return $this;
    }

    /**
     * Get hdr
     *
     * @return boolean
     */
    public function getHdr()
    {
        return $this->hdr;
    }

    /**
     * Set datenomination
     *
     * @param \DateTime $datenomination
     *
     * @return MembresCrestic
     */
    public function setDatenomination($datenomination)
    {
        $this->datenomination = $datenomination;

        return $this;
    }

    /**
     * Get datenomination
     *
     * @return \DateTime
     */
    public function getDatenomination()
    {
        return $this->datenomination;
    }

    /**
     * Set corpsgrade
     *
     * @param string $corpsgrade
     *
     * @return MembresCrestic
     */
    public function setCorpsgrade($corpsgrade)
    {
        $this->corpsgrade = $corpsgrade;

        return $this;
    }

    /**
     * Get corpsgrade
     *
     * @return string
     */
    public function getCorpsgrade()
    {
        return $this->corpsgrade;
    }

    /**
     * Set departementMembre
     *
     * @param Departements $departementMembre
     *
     * @return MembresCrestic
     */
    public function setDepartementMembre(Departements $departementMembre = null)
    {
        $this->departementMembre = $departementMembre;

        return $this;
    }

    /**
     * Get departementMembre
     *
     * @return Departements
     */
    public function getDepartementMembre()
    {
        return $this->departementMembre;
    }

    public function getStatutLong()
    {
        if ($this->getStatus() == 'MCF')
        {
            if ($this->getHdr() == true)
            {
                return 'MCF HDR';
            } else
            {
                return $this->getStatus();
            }
        } else
        {
            return $this->getStatus();
        }
    }

    /**
     * Add activite
     *
     * @param \AppBundle\Entity\Activites $activite
     *
     * @return MembresCrestic
     */
    public function addActivite(\AppBundle\Entity\Activites $activite)
    {
        $this->activites[] = $activite;

        return $this;
    }

    /**
     * Remove activite
     *
     * @param \AppBundle\Entity\Activites $activite
     */
    public function removeActivite(\AppBundle\Entity\Activites $activite)
    {
        $this->activites->removeElement($activite);
    }

    /**
     * Get activites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivites()
    {
        return $this->activites;
    }

    /**
     * Set evaluation
     *
     * @param string $evaluation
     *
     * @return MembresCrestic
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * Get evaluation
     *
     * @return string
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * Set editorial
     *
     * @param string $editorial
     *
     * @return MembresCrestic
     */
    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;

        return $this;
    }

    /**
     * Get editorial
     *
     * @return string
     */
    public function getEditorial()
    {
        return $this->editorial;
    }
}
