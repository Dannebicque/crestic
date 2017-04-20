<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PublicEquipesController
 * @package AppBundle\Controller
 * @Route("equipe")
 */
class PublicEquipesController extends Controller
{
    /**
     * @Route("/{slug}", name="public_equipes_profil")
     */
    public function pofilAction($slug)
    {
        $equipe = $this->getDoctrine()->getRepository('AppBundle:Equipes')->findOneBy(array('slug' => $slug));
        $membres = $this->getDoctrine()->getRepository('AppBundle:EquipesHasMembres')->findAllMembresFromEquipe($equipe->getId());

        return $this->render('AppBundle:PublicEquipes:pofil.html.twig', array(
            'equipe'  => $equipe,
            'membres' => $membres,
        ));
    }

}
