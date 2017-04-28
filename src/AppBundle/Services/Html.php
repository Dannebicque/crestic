<?php
/**
 * Created by PhpStorm.
 * User: D.ANNEBICQUE
 * Date: 21/04/2017
 * Time: 11:45
 */

namespace AppBundle\Services;


use AppBundle\Entity\MembresCrestic;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Router;

class Html
{
    /** @var Router */
    protected $router;

    public function __construct($_router)
    {
        $this->router = $_router;
    }

    public function linkAuteur(MembresCrestic $auteur, $texte = '')
    {
        $html = '<a href="';
        $html .= $this->router->generate('public_membres_profil', array('slug' => $auteur->getSlug()));
        $html .= 'title="Profil de '.$auteur->getDisplay().'"';
		$html .= 'target="_blank">';

		if ($texte == '')
        {
            $html .= $auteur->getDisplay();
        } else
        {
            $html .= $texte;
        }

        $html .=' </a>';
        return $html;
    }

    public function getUrl()
    {

    }
}