<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MembresExterieurs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MembresExterieursRepository")
 */
class MembresExterieurs
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
     * @ORM\Column(name="nomLabo", type="string", length=255, nullable=true)
     */
    private $nomLabo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="laboUrca", type="boolean")
     */
    private $laboUrca = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="international", type="boolean")
     */
    private $international = false;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumn(name="pays_id",referencedColumnName="id")
     */
    private $pays;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="ancienMembresCrestic", type="boolean")
     */
    private $ancienMembresCrestic = false;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;


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

    public function __toString()
    {
        return ucfirst($this->prenom).' '.ucfirst($this->nom);
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return MembresExterieurs
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return MembresExterieurs
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


    /**
     * Set nomLabo
     *
     * @param string $nomLabo
     *
     * @return MembresExterieurs
     */
    public function setNomLabo($nomLabo)
    {
        $this->nomLabo = $nomLabo;

        return $this;
    }

    /**
     * Get nomLabo
     *
     * @return string
     */
    public function getNomLabo()
    {
        return $this->nomLabo;
    }

    /**
     * Set situationLabo
     *
     * @param string $situationLabo
     *
     * @return MembresExterieurs
     */
    public function setSituationLabo($situationLabo)
    {
        $this->situationLabo = $situationLabo;

        return $this;
    }

    /**
     * Get situationLabo
     *
     * @return string
     */
    public function getSituationLabo()
    {
        return $this->situationLabo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return MembresExterieurs
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function getInitialePrenom()
    {
        $prenom = explode(' ', $this->prenom);
        $texte = '';
        foreach ($prenom as $item)
        {
            $texte .= strtoupper(substr($item,0,1)).'.&nbsp;';
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
//            //membre crestic
//            return $this->getMembreCrestic()->getInitialePrenom().' '.$this->getMembreCrestic()->getNom();
//        } else
//        {
            return $this->getInitialePrenom()."&nbsp;".$this->getNom();
        //}
    }

    /**
     * Set laboUrca
     *
     * @param boolean $laboUrca
     *
     * @return MembresExterieurs
     */
    public function setLaboUrca($laboUrca)
    {
        $this->laboUrca = $laboUrca;

        return $this;
    }

    /**
     * Get laboUrca
     *
     * @return boolean
     */
    public function getLaboUrca()
    {
        return $this->laboUrca;
    }

    /**
     * Set international
     *
     * @param boolean $international
     *
     * @return MembresExterieurs
     */
    public function setInternational($international)
    {
        $this->international = $international;

        return $this;
    }

    /**
     * Get international
     *
     * @return boolean
     */
    public function getInternational()
    {
        return $this->international;
    }

    /**
     * Set ancienMembresCrestic
     *
     * @param boolean $ancienMembresCrestic
     *
     * @return MembresExterieurs
     */
    public function setAncienMembresCrestic($ancienMembresCrestic)
    {
        $this->ancienMembresCrestic = $ancienMembresCrestic;

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
     * Set pays
     *
     * @param Pays $pays
     *
     * @return MembresExterieurs
     */
    public function setPays(Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return Pays
     */
    public function getPays()
    {
        return $this->pays;
    }
}
