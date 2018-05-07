<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationsConferences
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationsConferencesRepository")
 */
class PublicationsConferences  extends Publications
{
    protected $type = 'conference';
    protected $couleur = "#196ca3";

    public function getCouleur()
    {
        return $this->couleur;
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
     * @ORM\Column(name="serie", type="string", length=255, nullable=true)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="volume", type="string", length=255, nullable=true)
     */
    private $volume;

    /**
     * @var boolean
     *
     * @ORM\Column(name="comiteLecture", type="boolean")
     */
    private $comiteLecture = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="acte", type="boolean")
     */
    private $acte = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="invite", type="boolean")
     */
    private $invite = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="poster", type="boolean")
     */
    private $poster = false;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=20, nullable=true)
     */
    private $isbn;

    /**
     * @ORM\ManyToOne(targetEntity="Conferences", inversedBy="publications", fetch="EAGER")
     */
    private $conference;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumn(name="pays_id",referencedColumnName="id")
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="tauxSelection", type="string", length=255, nullable=true)
     */
    private $tauxSelection = '';

    /**
     *
     * @ORM\ManyToOne(targetEntity="Editeurs", inversedBy="revues")
     * @ORM\JoinColumn(name="editeur_id",referencedColumnName="id")
     */
    private $editeur;

    /**
     * @var string
     *
     * @ORM\Column(name="urlConference", type="string", length=255, nullable=true)
     */
    private $urlConference = '';

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
     * Set serie
     *
     * @param string $serie
     *
     * @return PublicationsConferences
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set volume
     *
     * @param string $volume
     *
     * @return PublicationsConferences
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set comiteLecture
     *
     * @param boolean $comiteLecture
     *
     * @return PublicationsConferences
     */
    public function setComiteLecture($comiteLecture)
    {
        $this->comiteLecture = $comiteLecture;

        return $this;
    }

    /**
     * Get comiteLecture
     *
     * @return boolean
     */
    public function getComiteLecture()
    {
        return $this->comiteLecture;
    }

    /**
     * Set acte
     *
     * @param boolean $acte
     *
     * @return PublicationsConferences
     */
    public function setActe($acte)
    {
        $this->acte = $acte;

        return $this;
    }

    /**
     * Get acte
     *
     * @return boolean
     */
    public function getActe()
    {
        return $this->acte;
    }

    /**
     * Set invite
     *
     * @param boolean $invite
     *
     * @return PublicationsConferences
     */
    public function setInvite($invite)
    {
        $this->invite = $invite;

        return $this;
    }

    /**
     * Get invite
     *
     * @return boolean
     */
    public function getInvite()
    {
        return $this->invite;
    }

    /**
     * Set poster
     *
     * @param boolean $poster
     *
     * @return PublicationsConferences
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return boolean
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return PublicationsConferences
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set conference
     *
     * @param Conferences $conference
     *
     * @return PublicationsConferences
     */
    public function setConference(Conferences $conference = null)
    {
        $this->conference = $conference;

        return $this;
    }

    /**
     * Get conference
     *
     * @return Conferences
     */
    public function getConference()
    {
        return $this->conference;
    }

    public function getNomConference()
    {
        if ($this->conference !== null)
        {
            if ($this->getConference()->getSigleConference() != '')
            {
                return $this->getConference()->getSigleConference();
            } else
            {
                $this->getConference()->getNomConference();
            }
        } else
        {
            return 'N.C';
        }
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return PublicationsConferences
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return PublicationsConferences
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
     * @return PublicationsConferences
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
     * Set tauxSelection
     *
     * @param string $tauxSelection
     *
     * @return PublicationsConferences
     */
    public function setTauxSelection($tauxSelection)
    {
        $this->tauxSelection = $tauxSelection;

        return $this;
    }

    /**
     * Get tauxSelection
     *
     * @return string
     */
    public function getTauxSelection()
    {
        return $this->tauxSelection;
    }

    /**
     * Set pays
     *
     * @param \AppBundle\Entity\Pays $pays
     *
     * @return PublicationsConferences
     */
    public function setPays(\AppBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \AppBundle\Entity\Pays
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set editeur
     *
     * @param \AppBundle\Entity\Editeurs $editeur
     *
     * @return PublicationsConferences
     */
    public function setEditeur(\AppBundle\Entity\Editeurs $editeur = null)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return \AppBundle\Entity\Editeurs
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set urlConference
     *
     * @param string $urlConference
     *
     * @return PublicationsConferences
     */
    public function setUrlConference($urlConference)
    {
        $this->urlConference = $urlConference;

        return $this;
    }

    /**
     * Get urlConference
     *
     * @return string
     */
    public function getUrlConference()
    {
        return $this->urlConference;
    }
}
