<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeOM
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DemandeOMRepository")
 */
class DemandeOM
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="date",nullable=true)
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRetour", type="date",nullable=true)
     */
    private $dateRetour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDepart", type="time", nullable=true)
     */
    private $heureDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureRetour", type="time", nullable=true)
     */
    private $heureRetour;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="text",nullable=true)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255,nullable=true)
     */
    private $ville;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="demandesOM",cascade={"persist"})
     * @ORM\JoinColumn(name="pays_id",referencedColumnName="id")
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="text", nullable=true)
     */
    private $etat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="omSansFrais", type="boolean")
     */
    private $omSansFrais = false;

    /**
     * @var string
     *
     * @ORM\Column(name="ligneBudget", type="string", length=150, nullable=true)
     */
    private $ligneBudget;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MembresCrestic",inversedBy="demandesOM")
     * @ORM\OrderBy({"nom" = "ASC", "prenom" = "ASC"})
     * @ORM\JoinColumn(name="membreCrestic_id",referencedColumnName="id")
     */
    private $membreCrestic;

    /**
     * @var \DateTime $created
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="etatdemande", type="string", length=1,nullable=true)
     */
    private $etatDemande = 'D';//D => demandé, A=> Acceptée, R=>Refusée, autres états ?

    /**
     * @var \DateTime $dateEtatDemande
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEtatDemande; //pour sauvegarder la réponse à la demande

    public function __construct()
    {
        $this->dateDepart = new \DateTime('now');
        $this->dateRetour = new \DateTime('now');
        $this->heureDepart = new \DateTime('08:00');
        $this->heureRetour = new \DateTime('18:00');
    }

    public function __toString()
    {
        return '' . $this->getObjet();
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return DemandeOM
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

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
     * @return DemandeOM
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     *
     * @return DemandeOM
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Get dateRetour
     *
     * @return \DateTime
     */
    public function getDateRetour()
    {
        return $this->dateRetour;
    }

    /**
     * Set dateRetour
     *
     * @param \DateTime $dateRetour
     *
     * @return DemandeOM
     */
    public function setDateRetour($dateRetour)
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    /**
     * Get heureDepart
     *
     * @return \DateTime
     */
    public function getHeureDepart()
    {
        return $this->heureDepart;
    }

    /**
     * Set heureDepart
     *
     * @param \DateTime $heureDepart
     *
     * @return DemandeOM
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    /**
     * Get heureRetour
     *
     * @return \DateTime
     */
    public function getHeureRetour()
    {
        return $this->heureRetour;
    }

    /**
     * Set heureRetour
     *
     * @param \DateTime $heureRetour
     *
     * @return DemandeOM
     */
    public function setHeureRetour($heureRetour)
    {
        $this->heureRetour = $heureRetour;

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
     * Set ville
     *
     * @param string $ville
     *
     * @return DemandeOM
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

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
     * Set pays
     *
     * @param string $pays
     *
     * @return DemandeOM
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

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
     * @return DemandeOM
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return DemandeOM
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get membre
     *
     * @return MembresCrestic
     */
    public function getMembreCrestic()
    {
        return $this->membreCrestic;
    }

    /**
     * Set membre
     *
     * @param MembresCrestic|null $membreCrestic
     *
     * @return DemandeOM
     */
    public function setMembreCrestic(MembresCrestic $membreCrestic = null)
    {
        $this->membreCrestic = $membreCrestic;

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
     * @return DemandeOM
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get etatDemande
     *
     * @return string
     */
    public function getEtatDemande()
    {
        return $this->etatDemande;
    }

    /**
     * Set etatDemande
     *
     * @param string $etatDemande
     *
     * @return DemandeOM
     */
    public function setEtatDemande($etatDemande = null)
    {
        $this->etatDemande = $etatDemande;

        return $this;
    }

    /**
     * Get dateEtatDemande
     *
     * @return \DateTime
     */
    public function getDateEtatDemande()
    {
        return $this->dateEtatDemande;
    }

    /**
     * Set dateEtatDemande
     *
     * @param \DateTime $dateEtatDemande
     *
     * @return DemandeOM
     */
    public function setDateEtatDemande($dateEtatDemande)
    {
        $this->dateEtatDemande = $dateEtatDemande;

        return $this;
    }

    /**
     * Get omSansFrais
     *
     * @return boolean
     */
    public function getOmSansFrais()
    {
        return $this->omSansFrais;
    }

    /**
     * Set omSansFrais
     *
     * @param boolean $omSansFrais
     *
     * @return DemandeOM
     */
    public function setOmSansFrais($omSansFrais)
    {
        $this->omSansFrais = $omSansFrais;

        return $this;
    }

    /**
     * Get ligneBduget
     *
     * @return string
     */
    public function getLigneBudget()
    {
        return $this->ligneBudget;
    }

    /**
     * Set ligneBduget
     *
     * @param $ligneBudget
     *
     * @return DemandeOM
     */
    public function setLigneBudget($ligneBudget)
    {
        $this->ligneBudget = $ligneBudget;

        return $this;
    }
}
