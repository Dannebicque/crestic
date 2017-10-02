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
    protected $couleur = "#FFAAAA";

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
}
