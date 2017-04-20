<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PublicProjetsController
 * @package AppBundle\Controller
 * @Route("/projets")
 */
class PublicProjetsController extends Controller
{
    /**
     * @Route("/{slug}", name="public_projet_profil")
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profilAction($slug)
    {
        $projet = $this->getDoctrine()->getRepository('AppBundle:Projets')->findOneBy(array('slug' => $slug));

        if ($projet)
        {
            $membres = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasMembres')->findAllMembresFromProjet($projet->getId());

            return $this->render('AppBundle:PublicProjets:profil.html.twig', array(
                'projet'  => $projet,
                'membres' => $membres
            ));
        } else
        {
            throw new NotFoundHttpException("Page not found");
        }
    }

}
