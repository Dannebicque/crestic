<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function profilAction($slug)
    {
        $equipe = $this->getDoctrine()->getRepository('AppBundle:Equipes')->findOneBy(array('slug' => $slug));
        if ($equipe)
        {
            $membres = $this->getDoctrine()->getRepository('AppBundle:EquipesHasMembres')->findAllMembresFromEquipe($equipe->getId());
            $sliders = $this->getDoctrine()->getRepository('AppBundle:EquipesHasSliders')->findAllSlidersFromEquipe($equipe->getId());

            return $this->render('@App/PublicEquipes/profil.html.twig', array(
                'equipe'  => $equipe,
                'membres' => $membres,
                'sliders' => $sliders
            ));
        } else
        {
            throw new NotFoundHttpException("Page not found");
        }
    }


}
