<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Conferences
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConferencesRepository")
 */
class Conferences
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
     * @ORM\Column(name="nomConference", type="string", length=255)
     */
    private $nomConference;

    /**
     * @var string
     *
     * @ORM\Column(name="sigleConference", type="string", length=100)
     */
    private $sigleConference;

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
    private $tauxSelection;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Editeurs", inversedBy="revues")
     * @ORM\JoinColumn(name="editeur_id",referencedColumnName="id")
     */
    private $editeur;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="internationale", type="boolean")
     */
    private $internationale = true;

    /**
     * @ORM\OneToMany(targetEntity="PublicationsConferences", mappedBy="conference")
     */
    private $publications;

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

    public function __toString()
    {
        return $this->getNomConference();
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
     * Set nomConference
     *
     * @param string $nomConference
     *
     * @return Conferences
     */
    public function setNomConference($nomConference)
    {
        $this->nomConference = $nomConference;

        return $this;
    }

    /**
     * Get nomConference
     *
     * @return string
     */
    public function getNomConference()
    {
        return $this->nomConference;
    }

    /**
     * Set sigleConference
     *
     * @param string $sigleConference
     *
     * @return Conferences
     */
    public function setSigleConference($sigleConference)
    {
        $this->sigleConference = $sigleConference;

        return $this;
    }

    /**
     * Get sigleConference
     *
     * @return string
     */
    public function getSigleConference()
    {
        return $this->sigleConference;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Conferences
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Conferences
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
     * @return Conferences
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
     * @return Conferences
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
     * @return Conferences
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
     * Constructor
     */
    public function __construct()
    {
        $this->publications = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set internationale
     *
     * @param boolean $internationale
     *
     * @return Conferences
     */
    public function setInternationale($internationale)
    {
        $this->internationale = $internationale;

        return $this;
    }

    /**
     * Get internationale
     *
     * @return boolean
     */
    public function getInternationale()
    {
        return $this->internationale;
    }

    /**
     * Add publication
     *
     * @param PublicationsConferences $publication
     *
     * @return Conferences
     */
    public function addPublication(PublicationsConferences $publication)
    {
        $this->publications[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param PublicationsConferences $publication
     */
    public function removePublication(PublicationsConferences $publication)
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

    public function display()
    {
        if ($this->sigleConference != '')
        {
            return $this->sigleConference.', '.$this->nomConference;
        } else
        {
            return $this->nomConference;
        }
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Conferences
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Conferences
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
     * @return Conferences
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
     * Set editeur
     *
     * @param Editeurs $editeur
     *
     * @return Conferences
     */
    public function setEditeur(Editeurs $editeur = null)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return Editeurs
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * @return string
     */
    public function getBibtex()
    {
        //12th International Workshop on Discrete Event Systems, {WODES} 2014,
        //Cachan, France, May 14-16, 2014.
        return 'conférence';
    }

    public function getjson()
    {
        return array('id' => $this->id,
                     'nom' => $this->nomConference,
                     'sigle' => $this->sigleConference);
    }
}
