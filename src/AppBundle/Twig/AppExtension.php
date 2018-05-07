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
            new \Twig_SimpleFilter('tel_format', array($this, 'telFormat')),
        );
    }

    public function telFormat($number)
    {
        $str = '';
        str_replace(['.', '-', ' '], '', $number);
        if (\strlen($number) === 10)
        {
            $str = chunk_split($number, 2, ' ');
        } else
        {
            $str = $number;
        }

        return $str;
    }

    public function linkMembre($obj)
    {
        if ($obj !== null) {
            $html = '<a href="' . $this->router->generate('public_membres_profil',
                    array('slug' => $obj->getSlug())) . '" target="_blank" title = "Profil de ' . $obj->getDisplay() . '">' . $obj->getDisplay() . '</a>';
        } else {
            $html = ' - ';
        }

        return $html;
    }
}