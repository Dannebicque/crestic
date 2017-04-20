<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Reseaux
 *
 * @ORM\Table()
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReseauxRepository")
 */
class Reseaux
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
     * @ORM\OneToMany(targetEntity="MembresHasReseaux", mappedBy="reseau")
     */   
    private $reseaux;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255,nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255,nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $image='noimage.png';

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="reseaux_images", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;


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
     * @return Reseaux
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
     * Set url
     *
     * @param string $url
     *
     * @return Reseaux
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
     * Constructor
     */
    public function __construct()
    {
        $this->reseaux = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add membreCrestic
     *
     * @param MembresHasReseaux $membreCrestic
     *
     * @return Reseaux
     */
    public function addMembreCrestic(MembresHasReseaux $membreCrestic)
    {
        $this->membresCrestic[] = $membreCrestic;

        return $this;
    }

    /**
     * Remove membreCrestic
     *
     * @param MembresHasReseaux $membreCrestic
     */
    public function removeReseaux(MembresHasReseaux $membreCrestic)
    {
        $this->membresCrestic->removeElement($membreCrestic);
    }

    /**
     * Get reseaux
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembresCrestic()
    {
        return $this->membresCrestic;
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
            $this->updated = new \DateTime('now');
        }
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Add reseau
     *
     * @param MembresHasReseaux $reseau
     *
     * @return Reseaux
     */
    public function addReseau(MembresHasReseaux $reseau)
    {
        $this->reseaux[] = $reseau;

        return $this;
    }

    /**
     * Remove reseau
     *
     * @param MembresHasReseaux $reseau
     */
    public function removeReseau(MembresHasReseaux $reseau)
    {
        $this->reseaux->removeElement($reseau);
    }

    /**
     * Get reseau
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReseaux()
    {
        return $this->reseaux;
    }

    /**
     * Add reseaux
     *
     * @param MembresHasReseaux $reseaux
     *
     * @return Reseaux
     */
    public function addReseaux(MembresHasReseaux $reseaux)
    {
        $this->reseaux[] = $reseaux;

        return $this;
    }
}
