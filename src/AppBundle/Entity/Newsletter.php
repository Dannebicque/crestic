<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NewsletterRepository")
 */
class Newsletter
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="envoye", type="boolean")
     */
    private $envoye = false;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BlocNewsletter", inversedBy="newletter")
     */
    private $blocs;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Newsletter
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set envoye
     *
     * @param boolean $envoye
     *
     * @return Newsletter
     */
    public function setEnvoye($envoye)
    {
        $this->envoye = $envoye;

        return $this;
    }

    /**
     * Get envoye
     *
     * @return bool
     */
    public function getEnvoye()
    {
        return $this->envoye;
    }
}

