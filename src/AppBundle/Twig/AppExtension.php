<?php
namespace AppBundle\Twig;

use AppBundle\Entity\MembresCrestic;
use Symfony\Component\Routing\Router;

class AppExtension extends \Twig_Extension
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('linkMembre', array($this, 'linkMembre')),
        );
    }

    public function linkMembre($obj)
    {
        if ($obj !== null)
        {
            $html = '<a href="'.$this->router->generate('public_membres_profil', array('slug' => $obj->getSlug())).'" target="_blank" title = "Profil de '.$obj->getDisplay().'">'.$obj->getDisplay().'</a>';
        } else
        {
            $html = ' - ';
        }

        return $html;
    }
}