<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @Vich\Uploadable
 * @ORM\DiscriminatorColumn(name="publication_type", type="string")
 * @ORM\DiscriminatorMap({"conference" = "PublicationsConferences", "revue" = "PublicationsRevues", "rapport" = "PublicationsRapports", "brevet" = "PublicationsBrevets", "ouvrage" = "PublicationsOuvrages", "chapitre" = "PublicationsChapitres", "these" = "PublicationsTheses"})
 */
abstract class Publications
{
    protected $type = 'publication';

    public function __toString()
    {
        $result = ''.$this->getTitre();

        return $result;
    }

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
     * @ORM\Column(name="titre", type="string", length=255,nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    private $resume;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="publications_pdf", fileNameProperty="pdf")
     *
     * @var File
     */
    private $pdfFile = '';

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="string", length=255, nullable=true)
     */
    private $pdf='';


    /**
     * @var string
     *
     * @ORM\Column(name="pdfVisible", type="boolean", length=255)
     */
    private $pdfVisible = false;


    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsHasMembres", mappedBy="publication",cascade={"persist"})
     * @ORM\JoinColumn(name="membre_id",referencedColumnName="id")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $membres;

    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsHasEquipes",mappedBy="publication",cascade={"persist"})
     * @ORM\JoinColumn(name="equipe_id",referencedColumnName="id")
     */
    private $equipes;

    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsHasDepartements", mappedBy="publication",cascade={"persist"})
     * @ORM\JoinColumn(name="equipe_id",referencedColumnName="id")
     */
    private $departements;

    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsHasPlateformes",mappedBy="publication",cascade={"persist"})
     * @ORM\JoinColumn(name="plateforme_id",referencedColumnName="id")
     */
    private $plateformes;

    /**
     *
     * @ORM\OneToMany(targetEntity="PublicationsHasProjets",mappedBy="publication",cascade={"persist"})
     * @ORM\JoinColumn(name="projet_id",referencedColumnName="id")
     */
    private $projets;

    /**
     * @var string
     *
     * @ORM\Column(name="doi", type="string", length=255, nullable=true)
     */
    private $doi;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="hal", type="string", length=255, nullable=true)
     */
    private $hal;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=true)
     */
    private $commentaire;

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
     * @var integer
     *
     * @ORM\Column(name="pageDebut", type="integer", nullable=true)
     */
    private $pageDebut;

    /**
     * @var integer
     *
     * @ORM\Column(name="pageFin", type="integer", nullable=true)
     */
    private $pageFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbPages", type="integer", nullable=true)
     */
    private $nbPages;

    /**
     * @var integer
     *
     * @ORM\Column(name="moisPublication", type="integer", nullable=true)
     */
    private $moisPublication;

    /**
     * @var integer
     *
     * @ORM\Column(name="anneePublication", type="integer", nullable=true)
     */
    private $anneePublication;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publicationInternationale", type="boolean")
     */
    private $publicationInternationale = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->membres      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipes      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->plateformes  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projets      = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Publications
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Publications
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     *
     * @return Publications
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set pdf
     *
     * @param string $pdf
     *
     * @return Publications
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdfVisible
     *
     * @return boolean
     */
    public function getPdfVisible()
    {
        return $this->pdfVisible;
    }

    /**
     * Set pdfVisible
     *
     * @param boolean $pdfVisible
     *
     * @return Publications
     */
    public function setPdfVisible($pdfVisible)
    {
        $this->pdfVisible = $pdfVisible;

        return $this;
    }

    /**
     * Get doi
     *
     * @return string
     */
    public function getDoi()
    {
        return $this->doi;
    }

    /**
     * Set doi
     *
     * @param string $doi
     *
     * @return Publications
     */
    public function setDoi($doi)
    {
        $this->doi = $doi;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Publications
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Add membre
     *
     * @param PublicationsHasMembres $membre
     *
     * @return Publications
     */
    public function addMembre(PublicationsHasMembres $membre)
    {
        $this->membres[] = $membre;

        return $this;
    }

    /**
     * Remove membre
     *
     * @param PublicationsHasMembres $membre
     */
    public function removeMembre(PublicationsHasMembres $membre)
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
     * Add equipe
     *
     * @param PublicationsHasEquipes $equipe
     *
     * @return Publications
     */
    public function addEquipe(PublicationsHasEquipes $equipe)
    {
        $this->equipes[] = $equipe;

        return $this;
    }

    /**
     * Remove equipe
     *
     * @param PublicationsHasEquipes $equipe
     */
    public function removeEquipe(PublicationsHasEquipes $equipe)
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
     * Add plateforme
     *
     * @param PublicationsHasPlateformes $plateforme
     *
     * @return Publications
     */
    public function addPlateforme(PublicationsHasPlateformes $plateforme)
    {
        $this->plateformes[] = $plateforme;

        return $this;
    }

    /**
     * Remove plateforme
     *
     * @param PublicationsHasPlateformes $plateforme
     */
    public function removePlateforme(PublicationsHasPlateformes $plateforme)
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
     * Add projet
     *
     * @param PublicationsHasProjets $projet
     *
     * @return Publications
     */
    public function addProjet(PublicationsHasProjets $projet)
    {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param PublicationsHasProjets $projet
     */
    public function removeProjet(PublicationsHasProjets $projet)
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
     * @return Publications
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
     * @return Publications
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get pageDebut
     *
     * @return integer
     */
    public function getPageDebut()
    {
        return $this->pageDebut;
    }

    /**
     * Set pageDebut
     *
     * @param integer $pageDebut
     *
     * @return Publications
     */
    public function setPageDebut($pageDebut)
    {
        $this->pageDebut = $pageDebut;

        return $this;
    }

    /**
     * Get pageFin
     *
     * @return integer
     */
    public function getPageFin()
    {
        return $this->pageFin;
    }

    /**
     * Set pageFin
     *
     * @param integer $pageFin
     *
     * @return Publications
     */
    public function setPageFin($pageFin)
    {
        $this->pageFin = $pageFin;

        return $this;
    }

    /**
     * Get nbPages
     *
     * @return integer
     */
    public function getNbPages()
    {
        $this->nbPages = $this->pageFin-$this->pageDebut;

        return $this->nbPages;
    }

    /**
     * Set nbPages
     *
     * @param integer $nbPages
     *
     * @return Publications
     */
    public function setNbPages($nbPages)
    {
        $this->nbPages = $this->pageFin-$this->pageDebut;

        //$this->nbPages = $nbPages;

        return $this;
    }

    /**
     * Get moisPublication
     *
     * @return integer
     */
    public function getMoisPublication()
    {
        return $this->moisPublication;
    }

    /**
     * Set moisPublication
     *
     * @param integer $moisPublication
     *
     * @return Publications
     */
    public function setMoisPublication($moisPublication)
    {
        $this->moisPublication = $moisPublication;

        return $this;
    }

    /**
     * Get anneePublication
     *
     * @return integer
     */
    public function getAnneePublication()
    {
        return $this->anneePublication;
    }

    /**
     * Set anneePublication
     *
     * @param integer $anneePublication
     *
     * @return Publications
     */
    public function setAnneePublication($anneePublication)
    {
        $this->anneePublication = $anneePublication;

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
     * @return Publications
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }


    /**
     * @return File
     */
    public function getPdfFile()
    {
        return $this->pdfFile;
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
    public function setPdfFile(File $image = null)
    {
        $this->pdfFile = $image;

        if ($image)
        {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated = new \DateTime('now');
        }
    }

    public function getMoisPublicationAbbrev()
    {
        $t = array('', 'Jan.', 'Feb.', 'Mar.', 'Apr.', 'May', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Oct.', 'Nov.', 'Dec.');

        return $t[$this->getMoisPublication()];
    }

    public function getPagination()
    {
        if ($this->pageDebut == 0 || $this->pageDebut == '')
        {
            return '';
        } else
        {
            return $this->pageDebut.'-'.$this->pageFin;
        }
    }

    /**
     * Set publicationInternationale
     *
     * @param boolean $publicationInternationale
     *
     * @return Publications
     */
    public function setPublicationInternationale($publicationInternationale)
    {
        $this->publicationInternationale = $publicationInternationale;

        return $this;
    }

    /**
     * Get publicationInternationale
     *
     * @return boolean
     */
    public function getPublicationInternationale()
    {
        return $this->publicationInternationale;
    }

    /**
     * Add departement
     *
     * @param PublicationsHasDepartements $departement
     *
     * @return Publications
     */
    public function addDepartement(PublicationsHasDepartements $departement)
    {
        $this->departements[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param PublicationsHasDepartements $departement
     */
    public function removeDepartement(PublicationsHasDepartements $departement)
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

    public function getType()
    {
        return $this->type;
    }

    /**
     * Set hal
     *
     * @param string $hal
     *
     * @return Publications
     */
    public function setHal($hal)
    {
        $this->hal = $hal;

        return $this;
    }

    /**
     * Get hal
     *
     * @return string
     */
    public function getHal()
    {
        return $this->hal;
    }
}
